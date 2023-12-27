<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $table = 'data_register';
    protected $primaryKey = 'id';
    protected $returnType = RegisterModel::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'email',
        'password',
        'number',
        'alamat',
    ];
}
