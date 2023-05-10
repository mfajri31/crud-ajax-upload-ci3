<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_siswa extends CI_Model
{
    public function get()
    {
        $query = $this->db->get('tb_siswa');
        return $query;
    }

    public function getById($id)
    {
        $query = $this->db->get_where('tb_siswa', ['id' => $id]);
        return $query;
    }

    public function insert($file)
    {
        $data = [
            'nama' => $this->input->post('nama', true),
            'file' => $file,
        ];

        $this->db->insert('tb_siswa', $data);
    }

    public function edit($id, $file)
    {
        if ($file != null) {
            $data = [
                "nama" => $this->input->post('nama', true),
                "file" => $file,
            ];
        } else {
            $data = [
                "nama" => $this->input->post('nama', true),
            ];
        }

        $this->db->where('id', $id);
        $this->db->update('tb_siswa', $data);
    }

    public function delete($id)
    {
        $this->db->delete('tb_siswa', ['id' => $id]);
    }
}