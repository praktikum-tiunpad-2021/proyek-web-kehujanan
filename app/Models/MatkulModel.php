<?php

namespace App\Models;

use CodeIgniter\Model;

class MatkulModel extends Model
{
  protected $table = 'matkul';
  protected $primaryKey = 'id_matkul';
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  public function getMatkul($id_matkul)
  {
    return $this->where(['id_matkul' => $id_matkul])->first();
  }
}