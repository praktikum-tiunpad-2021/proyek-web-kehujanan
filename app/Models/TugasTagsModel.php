<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasTagsModel extends Model
{
  protected $table = 'tugas_tags';
  protected $primaryKey = 'id_tag';
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  public function getMatkul($id_tugas_tag)
  {
    return $this->where(['id_tugas_tag' => $id_tugas_tag])->first();
  }
}
