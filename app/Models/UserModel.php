<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'user';
  protected $primaryKey = 'id_user';
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  public function getUser($id_user)
  {
    return $this->where(['id_user' => $id_user])->first();
  }
}