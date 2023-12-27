<?php

namespace App\Controllers;

use App\Models\MessagePenjualModel;
use CodeIgniter\RESTful\ResourceController;

class MessagePenjualController extends ResourceController

{
    protected $format = 'json';
    public function index()
    {
        $messagePenjualModel = new \App\Models\MessagePenjualModel();
        $data = $messagePenjualModel->findAll();
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
    public function createmessagepenjual()
    {
        $data = [
            'nama_pengirim' => $this->request->getVar('nama_pengirim'),
            'email_pengirim' => $this->request->getVar('email_pengirim'),
            'pesan' => $this->request->getVar('pesan'),
        ];
        $messagePenjualModel = new MessagePenjualModel();
        $messagePenjualModel->save($data);
        $response = [
            'status' => 200,
            'messages' => 'Data berhasil ditambahkan',
            'data' => $data,
        ];
        return $this->respond($response);
    }

    public function getmessagepenjual($id){

        $messagePenjualModel = new MessagePenjualModel();
        $messagepenjual = $messagePenjualModel->find($id);

        $data = [
            'nama_pengirim' => $this->request->getVar('nama_pengirim'),
            'email_pengirim' => $this->request->getVar('email_pengirim'),
            'pesan' => $this->request->getVar('pesan'),
        ];

        if ($messagepenjual) {
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
    public function updatemessagepenjual($id)
    {
        $messagePenjualModel = new MessagePenjualModel();
        $messagepenjual = $messagePenjualModel->find($id);
        if ($messagepenjual) {
            $data = [
                'nama_pengirim' => $this->request->getVar('nama_pengirim'),
                'email_pengirim' => $this->request->getVar('email_pengirim'),
                'pesan' => $this->request->getVar('pesan'),
            ];
            $proses = $messagePenjualModel->save($data);
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
    public function deletemessagepenjual($id = null){
        $messagePenjualModel = new MessagePenjualModel();
        $messagepenjual = $messagePenjualModel->find($id);

        if($messagepenjual){
        $proses = $messagePenjualModel->delete($id);

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