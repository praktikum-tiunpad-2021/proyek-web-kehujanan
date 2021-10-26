<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
  protected $table = 'tugas';
  protected $primaryKey = 'id_tugas';
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $allowedFields = ['id_tugas', 'nama_tugas', 'deskripsi', 'deadline', 'id_user', 'id_matkul'];

  public function getTugas($id_tugas)
  {
    return $this->where(['id_tugas' => $id_tugas])->first();
  }
}