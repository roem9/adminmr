<?php
class Dosen extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Admin_model");
    }

    public function index(){
        $data['title'] = "List Dosen";

        // get all (table, where, order)
        $data['dosen'] = $this->Admin_model->get_all("dosen", "", "nama_dosen");

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/dosen", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_dosen(){
            $data = [
                "nama_dosen" => $this->input->post("nama_dosen"),
                "status" => "Aktif"
            ];

            $result = $this->Admin_model->add_data("dosen", $data);
            
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> data dosen<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else 
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> data dosen<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

    // edit
        public function edit_dosen(){
            $id = $this->input->post("id_dosen");
            $data = [
                "nama_dosen" => $this->input->post("nama_dosen")
            ];

            // edit data (table, where, data)
            $result = $this->Admin_model->edit_data("dosen", ["id_dosen" => $id], $data);
            
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data dosen<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else 
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>mengubah</strong> data dosen<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit

    // get
        public function get_dosen_by_id(){
            $id = $this->input->post("id");
            
            // get one (table, where)
            $data = $this->Admin_model->get_one("dosen", ["id_dosen" => $id]);
            echo json_encode($data);
        }
    // get
}