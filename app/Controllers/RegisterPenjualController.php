<?php

namespace App\Controllers;

use App\Models\RegisterPenjualModel;
use CodeIgniter\RESTful\ResourceController;

class RegisterPenjualController extends ResourceController

{
    protected $format = 'json';
    public function index()
    {
        $registerpenjualModel = new \App\Models\RegisterPenjualModel();
        $data = $registerpenjualModel->findAll();
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
    public function createakunpenjual()
    {
        $data = [
            'nama_showroom' => $this->request->getVar('nama_showroom'),
            'email_showroom' => $this->request->getVar('email_showroom'),
            'alamat_showroom' => $this->request->getVar('alamat_showroom'),
            'number_showroom' => $this->request->getVar('number_showroom'),
            'password_penjual' => $this->request->getVar('password_penjual'),
        ];
        $registerpenjualModel = new RegisterPenjualModel();
        $registerpenjualModel->save($data);
        $response = [
            'status' => 200,
            'messages' => 'Data berhasil ditambahkan',
            'data' => $data,
        ];
        return $this->respond($response);
    }

    public function getakunpenjual($id){

        $registerpenjualModel = new RegisterPenjualModel();
        $registerpenjual = $registerpenjualModel->find($id);

        $data = [
            'nama_showroom' => $this->request->getVar('nama_showroom'),
            'email_showroom' => $this->request->getVar('email_showroom'),
            'alamat_showroom' => $this->request->getVar('alamat_showroom'),
            'password_penjual' => $this->request->getVar('password_penjual'),
        ];

        if ($registerpenjual) {
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
    public function updateakunpenjual($id)
    {
        $registerpenjualModel = new RegisterPenjualModel();
        $registerpenjual = $registerpenjualModel->find($id);
        if ($registerpenjual) {
            $data = [
                'nama_showroom' => $this->request->getVar('nama_showroom'),
                'email_showroom' => $this->request->getVar('email_showroom'),
                'alamat_showroom' => $this->request->getVar('alamat_showroom'),
                'number_showroom' => $this->request->getVar('number_showroom'),
                'password_penjual' => $this->request->getVar('password_penjual'),
            ];
            $proses = $registerpenjualModel->save($data);
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
    public function deleteakunpenjual($id = null){
        $registerpenjualModel = new RegisterPenjualModel();
        $registerpenjual = $registerpenjualModel->find($id);

        if($registerpenjual){
        $proses = $registerpenjualModel->delete($id);

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