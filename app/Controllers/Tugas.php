<?php

namespace App\Controllers;

use App\Models\TugasModel;
use App\Models\TagsModel;

class Tugas extends BaseController
{
  protected $tugasModel;
  protected $tagsModel;

  public function __construct()
  {
    $this->tugasModel = new TugasModel();
    $this->tagsModel = new TagsModel();
  }
  public function index()
  {
    $query = $this->tugasModel->select('tugas.id_tugas, nama_tugas, deadline, status, GROUP_CONCAT(COALESCE(nama_tag, "")) as nama_tag');
    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $tugas = $query->search($keyword);
    } else {
      $tugas = $query;
    }
    $user = session()->get('id_user');
    $currPage = $this->request->getVar('page_tugas') ? $this->request->getVar('page_tugas') : 1;
    $data = [
      'tugas' => $tugas->join('tags', 'tags.id_tugas = tugas.id_tugas', 'left')->where('tugas.id_user', $user)->groupBy('tugas.id_tugas')->paginate(5, 'tugas'),
      'keyword' => $keyword,
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
  }

  public function create()
  {
    $data = [
      'validation' => \Config\Services::validation(),
    ];

    return view('tugas/create', $data);
  }

  public function save()
  {
    $dataTugas = [
      'nama_tugas' => $this->request->getVar('nama_tugas'),
      'deskripsi' => $this->request->getVar('deskripsi'),
      'deadline' => $this->request->getVar('deadline'),
      'id_user' => session()->get('id_user'),
      'status' => 0
    ];



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


    $this->tugasModel->saveData($dataTugas);

    $tags = $this->request->getVar('tags');
    $id_tugas = $this->tugasModel->insertID();

    $dataTags = [];
    if ($tags != '') {
      $tagsArr = explode(',', $tags);
      $index = 0;
      foreach ($tagsArr as $tag) {
        $dataTags[$index]['id_tugas'] = $id_tugas;
        $dataTags[$index]['nama_tag'] = $tag;
        $index++;
      }
      $this->tagsModel->insertBatch($dataTags);
    }


    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
    return redirect()->to('/tugas');
  }

  public function edit($id_tugas)
  {
    $data = [
      'validation' => \Config\Services::validation(),
      'tugas' => $this->tugasModel->getTugas($id_tugas),
    ];

    return view('tugas/edit', $data);
  }

  public function update($id_tugas)
  {
    //dd($this->request->getVar());
    if ($this->request->getPost('statusUpdate') == 1) {
      $this->tugasModel->updateData($id_tugas, [
        'status' => $this->request->getPost('status'),
      ]);
      session()->setFlashdata('pesan', 'Status berhasil diubah.');
    } else {
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
        return redirect()->to('/tugas/edit/' . $this->request->getVar('id_tugas'))->withInput();
      }
      $this->tugasModel->updateData($id_tugas, [
        'id_tugas' => $id_tugas,
        'nama_tugas' => $this->request->getVar('nama_tugas'),
        'deskripsi' => $this->request->getVar('deskripsi'),
        'deadline' => $this->request->getVar('deadline'),
        'status' => $this->request->getVar('status'),

      ]);
      session()->setFlashdata('pesan', 'Data tugas berhasil diubah.');
    }

    return redirect()->to('/tugas');
  }
}