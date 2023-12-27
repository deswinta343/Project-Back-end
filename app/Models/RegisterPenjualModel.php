<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterPenjualModel extends Model
{
    protected $table = 'register_penjual';
    protected $primaryKey = 'id';
    protected $returnType = RegisterPenjualModel::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'nama_showroom',
        'email_showroom',
        'alamat_showroom',
        'number_showroom',
        'password_penjual',
    ];
}
