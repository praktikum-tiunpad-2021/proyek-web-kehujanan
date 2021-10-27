<?php

namespace App\Controllers;

use App\Models\TugasModel;
use App\Models\MatkulModel;
use App\Models\UserModel;

class Tugas extends BaseController
{
  protected $tugasModel;
  protected $matkulModel;
  protected $userModel;

  public function __construct()
  {
    $this->tugasModel = new TugasModel();
    $this->matkulModel = new MatkulModel();
    $this->userModel = new UserModel();
  }
  public function index()
  {
    $currPage = $this->request->getVar('page_tugas') ? $this->request->getVar('page_tugas') : 1;
    $data = [
      'tugas' => $this->tugasModel->paginate(null, 'tugas'),
      'pager' => $this->tugasModel->pager,
      'currentPage' => $currPage
    ];
    return view('tugas/index', $data);
  }

  public function detail($id_tugas)
  {
    $data = [
      'tugas' => $this->tugasModel->getTugas($id_tugas)
    ];

    return view('tugas/detail', $data);
  }

  public function delete($id_tugas)
  {
    $this->tugasModel->delete($id_tugas);
    session()->setFlashdata('pesan', 'Tugas dengan ID ' . $id_tugas . ' berhasil dihapus.');
    return redirect()->to('/tugas');
    // return redirect()->to('/');
  }

  public function create()
  {
    $data = [
      'validation' => \Config\Services::validation(),
      'user' => $this->userModel->findAll(),
      'matkul' => $this->matkulModel->findAll()
    ];

    return view('tugas/create', $data);
  }

  public function save()
  {
    if (!$this->validate([
      'nama_tugas' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'nama tugas harus diisi.'
        ]
      ],
      'deadline' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'deadline tugas harus diisi.'
        ]
      ]
    ])) {
      return redirect()->to('/tugas/create')->withInput();
    }

    $this->tugasModel->save([
      'nama_tugas' => $this->request->getVar('nama_tugas'),
      'deskripsi' => $this->request->getVar('deskripsi'),
      'deadline' => $this->request->getVar('deadline'),
      'id_user' => $this->request->getVar('id_user'),
      'id_matkul' => $this->request->getVar('id_matkul')
    ]);
    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
    return redirect()->to('/tugas');
  }

  public function edit($id_tugas)
  {
    $data = [
      'validation' => \Config\Services::validation(),
      'tugas' => $this->tugasModel->getTugas($id_tugas),
      'matkul' => $this->matkulModel->findAll(),
      'user' => $this->userModel->findAll()
    ];

    return view('tugas/edit', $data);
  }

  public function update($id_tugas)
  {
    //dd($this->request->getVar());
    //validasi
    if (!$this->validate([
      'nama_tugas' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama tugas harus diisi.',
        ]
      ],
      'deadline' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Deadline tugas harus diisi'
        ]
      ]
    ])) {
      // return redirect()->to('/tugas');
      return redirect()->to('/tugas/edit/' . $this->request->getVar('id_tugas'))->withInput();
    }else{

      $this->tugasModel->save([
        'id_tugas' => $id_tugas,
        'nama_tugas' => $this->request->getVar('nama_tugas'),
        'deskripsi' => $this->request->getVar('deskripsi'),
        'deadline' => $this->request->getVar('deadline'),
        'id_user' => $this->request->getVar('id_user'),
        'id_matkul' => $this->request->getVar('id_matkul')
      ]);
      session()->setFlashdata('pesan', 'Data berhasil diubah.');
      return redirect()->to('/tugas');
    }
  }
}