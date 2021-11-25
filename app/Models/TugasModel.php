<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
  protected $table = 'tugas';
  protected $primaryKey = 'id_tugas';
  protected $allowedFields = ['id_tugas', 'nama_tugas', 'deskripsi', 'deadline', 'id_user', 'id_matkul'];

  public function getTugas($id_tugas)
  {
    return $this->where(['id_tugas' => $id_tugas])->first();
  }
  public function getAllTugas()
  {
    return $this->findAll();
  }
  public function saveData($data)
  {
    return $this->db->table($this->table)->insert($data);
  }
  public function updateData($id, $data)
  {
    return $this->db->table($this->table)->update($data, array('id_tugas' => $id));
  }
  public function search($keyword)
  {
    return $this->table($this->table)->like('nama_tugas', $keyword);
  }
  public function tagFilter($tagkey)
  {
    return $this->table($this->table)->like('nama_tag', $tagkey);
  }
}