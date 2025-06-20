<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawan';
    protected $primaryKey       = 'karyawan_id';
    protected $useAutoIncrement = false; 
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['karyawan_id', 'nama', 'email', 'password', 'role', 'is_deleted', 'last_login', 'last_activity'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'is_deleted'; 

   
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        // Menghapus log debugging
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $plainPassword = $data['data']['password'];

        if ($plainPassword === '') {
            unset($data['data']['password']);
            return $data;
        }
      
        $hashedPassword = hash('sha256', $plainPassword);
        $data['data']['password'] = $hashedPassword;
        return $data;
    }
 }