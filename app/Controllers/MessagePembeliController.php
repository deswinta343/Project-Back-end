<?php

namespace App\Controllers;

use App\Models\MessagePembeliModel;
use CodeIgniter\RESTful\ResourceController;

class MessagePembeliController extends ResourceController

{
    protected $format = 'json';
    public function index()
    {
        $messagePembeliModel = new \App\Models\MessagePembeliModel();
        $data = $messagePembeliModel->findAll();
        if (!empty($data)) {
            $response = [
                'status' => 200,
                'message' => 'Data retrieved successfully',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 404, // 404 Not Found
                'message' => 'No data found',
                'data' => []
            ];
        }
        return $this->respond($response);
    }
    public function createmessagepembeli()
    {
        $data = [
            'nama_pengirim' => $this->request->getVar('nama_pengirim'),
            'email_pengirim' => $this->request->getVar('email_pengirim'),
            'pesan' => $this->request->getVar('pesan'),
        ];
        $messagePembeliModel = new MessagePembeliModel();
        $messagePembeliModel->save($data);
        $response = [
            'status' => 200,
            'messages' => 'Data berhasil ditambahkan',
            'data' => $data,
        ];
        return $this->respond($response);
    }

    public function getmessagepembeli($id){

        $messagePembeliModel = new MessagePembeliModel();
        $messagepembeli = $messagePembeliModel->find($id);

        $data = [
            'nama_pengirim' => $this->request->getVar('nama_pengirim'),
            'email_pengirim' => $this->request->getVar('email_pengirim'),
            'pesan' => $this->request->getVar('pesan'),
        ];

        if ($messagepembeli) {
            $response = [
                'status' => 200,
                'messages' => 'Data berhasil diubah',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 402,
                'messages' => 'Gagal diubah',
            ];
        }

    }
    // function untuk mengedit data
    public function updatemessagepembeli($id)
    {
        $messagePembeliModel = new MessagePembeliModel();
        $messagepembeli = $messagePembeliModel->find($id);
        if ($messagepembeli) {
            $data = [
                'nama_pengirim' => $this->request->getVar('nama_pengirim'),
                'email_pengirim' => $this->request->getVar('email_pengirim'),
                'pesan' => $this->request->getVar('pesan'),
            ];
            $proses = $messagePembeliModel->save($data);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data berhasil diubah',
                    'data' => $data
                ];
            } else {
                $response = [
                    'status' => 402,
                    'messages' => 'Gagal diubah',
                ];
            }
            return $this->respond($response);
        }
        return $this->failNotFound('Data tidak ditemukan');
    }
    //delete
    public function deletemessagepembeli($id = null){
        $messagePembeliModel = new MessagePembeliModel();
        $messagepembeli = $messagePembeliModel->find($id);

        if($messagepembeli){
        $proses = $messagePembeliModel->delete($id);

        if ($proses) {
        $response = [
            'status' => 200,
            'messages' => 'Data berhasil dihapus',
            ];
        }else {
        $response = [
            'status' => 402,
            'messages' => 'Gagal menghapus data',
            ];
        }
            return $this->respond($response);
        }else{
            return $this->failNotFound('Data tidak ditemukan');
        }

    }

}