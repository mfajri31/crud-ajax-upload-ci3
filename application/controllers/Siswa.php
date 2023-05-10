<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_siswa');
    }

    public function index()
    {
        $data['siswa'] = $this->M_siswa->get()->result_array();
        $this->template->view('siswa/index', $data);
    }

    public function tambah()
    {
        $this->template->view('siswa/tambah');
    }

    public function edit($id)
    {
        $data['siswa'] = $this->M_siswa->getById($id)->row_array();
        $this->template->view('siswa/edit', $data);
    }

    public function prosesTambah()
    {
        $file = $this->_do_upload();
        $this->M_siswa->insert($file);
    }

    public function prosesEdit()
    {
        $id       = $this->input->post('id');
        $siswa    = $this->M_siswa->getById($id)->row_array();
        $file     = $_FILES['file']['name'];
        $fileLama = $siswa['file'];

        if ($file) {
            unlink("assets/files/" . $fileLama);

            $file = $this->_do_upload();
            $this->M_siswa->edit($id, $file);
        } else {
            $this->M_siswa->edit($id, $file);
        }
    }

    public function hapus($id)
    {
        $siswa    = $this->M_siswa->getById($id)->row_array();
        $fileLama = $siswa['file'];

        unlink("assets/files/" . $fileLama);

        $this->M_siswa->delete($id);
        redirect('siswa');
    }

    private function _do_upload()
    {
        $config['upload_path']   = './assets/files/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('siswa/tambah', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data']['file_name'];
        }
    }
}