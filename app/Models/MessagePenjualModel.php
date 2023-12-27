<?php

namespace App\Models;

use CodeIgniter\Model;

class MessagePenjualModel extends Model
{
    protected $table = 'message_text2';
    protected $primaryKey = 'id';
    protected $returnType = MessagePenjualModel::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'nama_pengirim',
        'email_pengirim',
        'pesan',
    ];
}
