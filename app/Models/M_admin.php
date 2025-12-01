<?php

namespace App\Models;

use CodeIgniter\Model;

class M_admin extends Model
{
    protected $table      = 'login';
    protected $primaryKey = 'iduser';
    protected $allowedFields = ['username', 'password'];

    public function getAll()
    {
        return $this->findAll();
    }
}
