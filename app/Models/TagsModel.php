<?php

namespace App\Models;

use CodeIgniter\Model;

class TagsModel extends Model
{
  protected $table = 'tags';
  protected $primaryKey = 'id_tag';
  protected $allowedFields = ['id_tugas', 'nama_tag'];

  public function getTags($id_tag)
  {
    return $this->where(['id_tag' => $id_tag])->first();
  }
  public function saveTags($data)
  {
    return $this->db->table($this->table)->insertBatch($data);
  }
}