<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id_user';
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $allowedFields = ['firstname', 'lastname', 'email', 'password', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  public function getUser($id_user)
  {
    return $this->where(['id_user' => $id_user])->first();
  }
  protected function beforeInsert(array $data)
  {
    $data = $this->passwordHash($data);
    return $data;
  }
  protected function beforeUpdate(array $data)
  {
    $data = $this->passwordHash($data);
    return $data;
  }

  protected function passwordHash(array $data)
  {
    if (isset($data['data']['password'])) {
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
    }
    return $data;
  }
}
