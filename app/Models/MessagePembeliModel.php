<?php

namespace App\Models;

use CodeIgniter\Model;

class MessagePembeliModel extends Model
{
    protected $table = 'message_text';
    protected $primaryKey = 'id';
    protected $returnType = MessagePembeliModel::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'nama_pengirim',
        'email_pengirim',
        'pesan',
    ];
}
