<?php
class Kelas extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Admin_model");
    }

    public function index(){
        $data['title'] = "List Kelas";

        $data['kelas'] = [];
        // get all (table, where, order)
        $kelas = $this->Admin_model->get_all("kelas", "", "nama_kelas");
        foreach ($kelas as $i => $kelas) {
            $data['kelas'][$i] = $kelas;
            $data['kelas'][$i]['dosen'] = $this->Admin_model->get_one("dosen", ["id_dosen" => $kelas['id_dosen']]);
            $data['kelas'][$i]['mahasiswa'] = COUNT($this->Admin_model->get_all("user", ["id_kelas" => $kelas['id_kelas'], "status" => "Aktif"]));
        }

        $data['dosen'] = [];
        $dosen = $this->Admin_model->get_all("dosen", "", "nama_dosen");
        foreach ($dosen as $i => $dosen) {
                $data['dosen'][$i] = $dosen;
        }

        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/kelas", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_kelas(){
            $id_dosen = $this->input->post("id_dosen");
            if($id_dosen == "")
                $id_dosen = NULL;
            $data = [
                "nama_kelas" => $this->input->post("nama_kelas"),
                "mustawa" => $this->input->post("mustawa", TRUE),
                "id_dosen" => $id_dosen
            ];

            // cek apakah dosen sudah memiliki kelas
            $check = $this->Admin_model->get_one("kelas", ["id_dosen" => $id_dosen]);
            if(!$check){
                $result = $this->Admin_model->add_data("kelas", $data);
            }
            
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> data kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else 
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> data kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

    // edit
        public function edit_kelas(){
            $id = $this->input->post("id_kelas");
            $id_dosen = $this->input->post("id_dosen");
            if($id_dosen == "")
                $id_dosen = NULL;
            $data = [
                "nama_kelas" => $this->input->post("nama_kelas"),
                "mustawa" => $this->input->post("mustawa", TRUE),
                "id_dosen" => $id_dosen
            ];

            // cek apakah dosen sudah memiliki kelas
            $check = $this->Admin_model->get_one("kelas", ["id_dosen" => $id_dosen]);
            if(!$check){
                // edit data (table, where, data)
                $result = $this->Admin_model->edit_data("kelas", ["id_kelas" => $id], $data);
            }
            
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else 
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>mengubah</strong> data kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit

    // get
        public function get_kelas_by_id(){
            $id = $this->input->post("id");
            $data = $this->Admin_model->get_one("kelas", ["id_kelas" => $id]);
            echo json_encode($data);
        }
    // get
}