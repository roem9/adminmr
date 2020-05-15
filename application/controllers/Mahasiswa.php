<?php
class Mahasiswa extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Admin_model");
    }

    public function aktif(){
        $data['title'] = "List Mahasiswa Aktif";

        $data['mahasiswa'] = [];
        
        // get all (table, where, order)
        $mahasiswa = $this->Admin_model->get_all("user", ["status" => "Aktif"], "nama");
        foreach ($mahasiswa as $i => $mahasiswa) {
            $data['mahasiswa'][$i] = $mahasiswa;
            $kelas = $this->Admin_model->get_one("kelas", ["id_kelas" => $mahasiswa['id_kelas']]);
            $data['mahasiswa'][$i]['kelas'] = [];
            $data['mahasiswa'][$i]['dosen'] = [];
            if($kelas){
                $data['mahasiswa'][$i]['kelas'] = $kelas;
                $data['mahasiswa'][$i]['dosen'] = $this->Admin_model->get_one("dosen", ["id_dosen" => $kelas['id_dosen']]);
            }
            $kata_user = $this->Admin_model->get_all_group_by("kata_user", ["id_user" => $mahasiswa['id_user']]);
            $data['mahasiswa'][$i]['kata'] = 0;
            foreach ($kata_user as $kata) {
                $mufrodat = COUNT($this->Admin_model->get_all("kata_user", ["id_mufrodat" => $kata['id_mufrodat']]));
                if($mufrodat == 2){
                    $jumlah_kata = $this->Admin_model->get_one("mufrodat", ["id_mufrodat" => $kata['id_mufrodat']]);
                    $data['mahasiswa'][$i]['kata'] += $jumlah_kata['kata'];
                }
            }
        }

        // var_dump($data);
        // exit();
        $data['kelas'] = $this->Admin_model->get_all("kelas");

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/mahasiswa", $data);
        $this->load->view("templates/footer");
    }
    
    public function nonaktif(){
        $data['title'] = "List Mahasiswa Nonaktif";
        $data['mahasiswa'] = [];

        $mahasiswa = $this->Admin_model->get_all("user", ["status" => "Nonaktif"], "nama");
        foreach ($mahasiswa as $i => $mahasiswa) {
            $data['mahasiswa'][$i] = $mahasiswa;
            $kelas = $this->Admin_model->get_one("kelas", ["id_kelas" => $mahasiswa['id_kelas']]);
            $data['mahasiswa'][$i]['kelas'] = [];
            $data['mahasiswa'][$i]['dosen'] = [];
            if($kelas){
                $data['mahasiswa'][$i]['kelas'] = $kelas;
                $data['mahasiswa'][$i]['dosen'] = $this->Admin_model->get_one("dosen", ["id_dosen" => $kelas['id_dosen']]);
            }
            $kata_user = $this->Admin_model->get_all_group_by("kata_user", ["id_user" => $mahasiswa['id_user']]);
            $data['mahasiswa'][$i]['kata'] = 0;
            foreach ($kata_user as $kata) {
                $mufrodat = COUNT($this->Admin_model->get_all("kata_user", ["id_mufrodat" => $kata['id_mufrodat']]));
                if($mufrodat == 2){
                    $jumlah_kata = $this->Admin_model->get_one("mufrodat", ["id_mufrodat" => $kata['id_mufrodat']]);
                    $data['mahasiswa'][$i]['kata'] += $jumlah_kata['kata'];
                }
            }
        }

        // var_dump($data);
        // exit();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/mahasiswa", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_mahasiswa(){
            $id_kelas = $this->input->post("id_kelas");
            if($id_kelas == "")
                $id_kelas = NULL;

            $data = [
                "nama" => $this->input->post("nama"),
                "id_kelas" => $id_kelas,
                "status" => "Aktif"
            ];

            $result = $this->Admin_model->add_data("user", $data);
            
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> data mahasiswa<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else 
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> data mahasiswa<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

    // edit
        public function edit_mahasiswa(){
            $id = $this->input->post("id_user");
            $id_kelas = $this->input->post("id_kelas");
            if($id_kelas == "")
                $id_kelas = NULL;

            $data = [
                "nama" => $this->input->post("nama"),
                "id_kelas" => $id_kelas,
                "status" => $this->input->post("status")
            ];

            // edit data (table, where, data)
            $result = $this->Admin_model->edit_data("user", ["id_user" => $id], $data);
            
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data mahasiswa<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else 
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>mengubah</strong> data mahasiswa<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit

    // get
        public function get_mahasiswa_by_id(){
            $id = $this->input->post("id");
            // get_one_by ($table, where)
            $data = $this->Admin_model->get_one("user", ["id_user" => $id]);
            echo json_encode($data);
        }
    // get
}