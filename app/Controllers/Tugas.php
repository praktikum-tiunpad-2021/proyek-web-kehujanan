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
    $query = $this->tugasModel->select('tugas.id_tugas as id_tugas, tugas.nama_tugas as nama_tugas, tugas.deadline as deadline, tugas.status as status, GROUP_CONCAT(COALESCE(tags.nama_tag, "")) as nama_tag');
    $keyword = $this->request->getVar('keyword');
    $tagkey = $this->request->getVar('tagchoice');
    if ($keyword) {
      $tugas = $query->search($keyword);
    } else if ($tagkey) {
      $tugas = $query->tagFilter($tagkey);
    } else {
      $tugas = $query;
    }
    $user = session()->get('id_user');
    $currPage = $this->request->getVar('page_tugas') ? $this->request->getVar('page_tugas') : 1;
    $data = [
      'tags' => $this->tagsModel->join('tugas', 'tugas.id_tugas = tags.id_tugas')->where('tugas.id_user', $user)->groupBy('nama_tag')->findAll(),
      'tugas' => $tugas->join('tags', 'tags.id_tugas = tugas.id_tugas', 'left')->where('tugas.id_user', $user)->groupBy('tugas.id_tugas')->paginate(5, 'tugas'),
      'keyword' => $keyword,
      'tagkey' => $tagkey,
      'pager' => $this->tugasModel->pager,
      'currentPage' => $currPage
    ];
    return view('tugas/index', $data);
  }

  public function detail($id_tugas)
  {
    $tugasTags = $this->tugasModel->join('tags', 'tags.id_tugas = tugas.id_tugas', 'left')->where('tugas.id_tugas', $id_tugas)->findAll();
    $tugas = $this->tugasModel->getTugas($id_tugas);
    $tugasAllTag = implode(",", array_column($tugasTags, 'nama_tag'));
    $data = [
      'tugas' => $tugas,
      'tags' => $tugasAllTag
    ];

    return view('tugas/detail', $data);
  }

  public function delete($id_tugas)
  {
    $tagsDB = $this->tagsModel->where('id_tugas', $id_tugas)->findAll();
    foreach ($tagsDB as $tDB) {
      $this->tagsModel->where('nama_tag', $tDB['nama_tag'])->delete();
    }
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
    $tugasTags = $this->tugasModel->join('tags', 'tags.id_tugas = tugas.id_tugas', 'left')->where('tugas.id_tugas', $id_tugas)->findAll();
    $tugasAllTag = implode(",", array_column($tugasTags, 'nama_tag'));
    $data = [
      'validation' => \Config\Services::validation(),
      'tugas' => $this->tugasModel->getTugas($id_tugas),
      'tags' => $tugasAllTag
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
      $tags = $this->request->getVar('tags');
      $tagsDB = $this->tagsModel->where('id_tugas', $id_tugas)->findAll();
      $tugasTags = implode(",", array_column($tagsDB, 'nama_tag'));
      $dataTags = [];
      if ($tags != '') {
        $tagsArr = explode(',', $tags);
        $index = 0;
        foreach ($tagsArr as $tag) {
          $dataTags[$index]['id_tugas'] = $id_tugas;
          $dataTags[$index]['nama_tag'] = $tag;
          $index++;
        }
        if ($tugasTags != $tags) {
          foreach ($tagsDB as $tDB) {
            $this->tagsModel->where('nama_tag', $tDB['nama_tag'])->delete();
          }
          $this->tagsModel->insertBatch($dataTags);
        }
      }
      session()->setFlashdata('pesan', 'Data tugas berhasil diubah.');
    }

    return redirect()->to('/tugas');
  }
}