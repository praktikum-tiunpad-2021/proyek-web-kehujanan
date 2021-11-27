<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{

  protected $model;

  public function __construct()
  {
    $this->model = new UsersModel();
  }

  public function index()
  {
    $data = [];
    helper(['form']);

    if ($this->request->getMethod() == 'post') {
      $rules = [
        'email' => 'required|min_length[6]|max_length[50]|valid_email',
        'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
      ];

      $errors = [
        'password' => [
          'validateUser' => 'Email atau Password salah!'
        ]
      ];

      if (!$this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
      } else {
        $user = $this->model->where('email', $this->request->getVar('email'))->first();
        $this->setUserSession($user);
        return redirect()->to('/dashboard');
      }
    }
    return view('/login', $data);
  }

  private function setUserSession($user)
  {
    $data = [
      'id_user' => $user['id_user'],
      'nama_user' => $user['nama_user'],
      'email' => $user['email'],
      'isLoggedIn' => true
    ];

    session()->set($data);
    return true;
  }
  public function register()
  {
    $data = [];
    helper(['form']);

    if ($this->request->getMethod() == 'post') {
      //do the validation here
      $rules = [
        'nama_user' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]|max_length[255]',
        'password_confirm' => 'matches[password]',
      ];

      if (!$this->validate($rules)) {
        $data['validation'] = $this->validator;
      } else {
        //store the user
        $newData = [
          'nama_user' => $this->request->getVar('nama_user'),
          'email' => $this->request->getVar('email'),
          'password' => $this->request->getVar('password'),
        ];
        $this->model->save($newData);
        session()->setFlashdata('pesan', 'Berhasil Registrasi!');
        return redirect()->to('/');
      }
    }

    return view('/register');
  }
  public function dashboard()
  {
    $data = [
      'title' => 'Dashboard'
    ];
    return view('dashboard', $data);
  }
  public function profile()
  {
    helper(['form']);
    $id_user = session()->get('id_user');
    $data = [
      'user' => $this->model->where('id_user', $id_user)->first(),
      'title' => 'Profile'
    ];
    if ($this->request->getMethod() == 'post') {
      $rules = [
        'nama_user' => 'required|min_length[3]|max_length[255]',
      ];

      if ($this->request->getPost('password') != '') {
        $rules['password'] = 'required|min_length[8]|max_length[255]';
        $rules['password_confirm'] = 'matches[password]';
      }

      if (!$this->validate($rules)) {
        $data['validation'] = $this->validator;
      } else {
        $newData = [
          'nama_user' => $this->request->getPost('nama_user'),
        ];

        if ($this->request->getPost('password') != '') {
          $newData['password'] = $this->request->getPost('password');
        }
        $this->model->update($id_user, $newData);
        session()->setFlashdata('success', 'Successful Updated');
        return redirect()->to('/profile');
      }
    }
    return view('/profile', $data);
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to('/');
  }
}