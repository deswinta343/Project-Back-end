<?php

namespace App\Controllers;

use App\Models\RegisterModel;
use CodeIgniter\RESTful\ResourceController;

class RegisterController extends ResourceController

{
    protected $format = 'json';
    public function index()
    {
        $registerModel = new \App\Models\RegisterModel();
        $data = $registerModel->findAll();
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
    public function create()
    {
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'number' => $this->request->getVar('number'),
            'alamat' => $this->request->getVar('alamat'),
        ];
        $registerModel = new RegisterModel();
        $registerModel->save($data);
        $response = [
            'status' => 200,
            'messages' => 'Data berhasil ditambahkan',
            'data' => $data,
        ];
        return $this->respond($response);
    }

    public function getUser($id){

        $registerModel = new RegisterModel();
        $register = $registerModel->find($id);

        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'number' => $this->request->getVar('number'),
            'alamat' => $this->request->getVar('alamat'),
        ];

        if ($register) {
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
    public function updateUser($id)
    {
        $registerModel = new RegisterModel();
        $register = $registerModel->find($id);
        if ($register) {
            $data = [
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'number' => $this->request->getVar('number'),
                'alamat' => $this->request->getVar('alamat'),
            ];
            $proses = $registerModel->save($data);
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
    public function deleteUser($id = null){
        $registerModel = new RegisterModel();
        $register = $registerModel->find($id);

        if($register){
        $proses = $registerModel->delete($id);

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

    public function Login() {
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $registerModel = new RegisterModel();
        $cek_data = $registerModel->where($data['email'])->first();

        if (!$cek_data) {
            $response = [
                'status' => 401,
                'messages' => 'Login Failed, akun tidak ditemukan',
                ];
            }else {
                if ($data['email'] == $cek_data['email']){
                    $response = [
                        'status' => 200,
                        'messages' => 'Login success!',
                        'data'     => $cek_data
                        ];
                }else{
                    $response = [
                        'status' => 402,
                        'messages' => 'Login Failed, Password salah'
                    ];
                }
            }
            return $this->respond($response);
    }
}