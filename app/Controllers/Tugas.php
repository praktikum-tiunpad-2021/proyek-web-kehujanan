<?php

namespace App\Controllers;

use App\Models\TugasModel;
use App\Models\TagsModel;
use CodeIgniter\HTTP\Response;

use function PHPUnit\Framework\containsEqual;

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
    // $query = $this->tugasModel->select('tugas.id_tugas as id_tugas, tugas.nama_tugas as nama_tugas, tugas.deadline as deadline, tugas.status as status, tags.nama_tag as nama_tag');
    // session()->set('atackOnTitan','gokuDrip');
    $user = session()->get('id_user');
    $selectedTags = $this->request->getVar('selectedTags');
    $keyword = $this->request->getVar('keyword');
    $isPost = $this->request->getMethod() == "post";
    if ($isPost) {
      session()->set('selectedTags',$selectedTags);
      session()->set('keyword',$keyword);
    }else{
      $selectedTags = session()->get('selectedTags');
      $keyword = session()->get('keyword');
    }
    $tagkey = $this->request->getVar('tagchoice');
    $tugas = $this->tugasModel->where('id_user', $user)->join('tags', 'tugas.id_tugas = tags.id_tugas', 'left outer')->groupBy('tugas.id_tugas')->select('tugas.id_tugas as id_tugas, tugas.nama_tugas as nama_tugas, tugas.deadline as deadline, tugas.status as status, tags.nama_tag as nama_tag, tugas.deskripsi as deskripsi');
    if ($keyword) {
      $tugas = $tugas->search($keyword);
    }
    $tugas = $tugas->findAll();
    // if ($keyword == null || $keyword == "") $keyword = "";
    if ($selectedTags == null || $selectedTags == "") $selectedTags = [];
    foreach ($tugas as $key => &$t) {
        $idt = $t['id_tugas'];
        $datestr = $t['deadline'];
        $date=strtotime($datestr);

        $diff=$date-time();
        $days=floor($diff/(60*60*24));
        $hours=floor(($diff-$days*60*60*24)/(60*60));
        $mins=round(($diff-$days*60*60*24-$hours*60*60)/60);
        $timeLeft = "$days days $hours hours $mins mins";
        $t['timeLeft'] = $timeLeft;

        $tugasTags = array_column($this->tagsModel->where('id_tugas',$idt)->findAll(),'nama_tag');
        $t['nama_tag'] = $tugasTags;
        foreach ($selectedTags as $tagkey) {
          if ($tagkey != null && $tagkey != ""){
            if(!in_array($tagkey,$tugasTags))
            unset($tugas[$key]);
            // $tugas = $tugas->tagFilter($tagkey);
          }
        }
    }

    $tags = $this->tagsModel->select('nama_tag')->groupBy('nama_tag')->join('tugas','tugas.id_tugas = tags.id_tugas')->where('id_user',$user)->findAll();
    $tags = array_column($tags,'nama_tag');
    sort($tags);
    $currPage = $this->request->getVar('page_tugas') ? $this->request->getVar('page_tugas'): 1;
    $data = [
      'tags' => $tags,
      'tugas' => $tugas,
      'keyword' => $keyword,
      'tagkey' => $tagkey,
      'pager' => $this->tugasModel->pager,
      'currentPage' => $currPage,
      'selectedTags' => $selectedTags,
      'isPost' => $isPost
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
    $isSuccess = $this->tugasModel->delete($id_tugas);
    $this->response->setHeader('status', $isSuccess ? 'dihapus' : 'gagal');
    $this->response->setHeader('pesan', 'Tugas dengan ID ' . $id_tugas . ($isSuccess ? ' berhasil' : ' gagal' ).' dihapus');
    return $this;
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
      session()->setFlashdata('pesan', 'Data gagal ditambahkan.');
      session()->setFlashdata('isError', 'true');
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
    return redirect()->to('/tugas/index');
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

  public function markStatus($id_tugas){
    $tugas = $this->tugasModel->getTugas($id_tugas);
    $status = $tugas['status'] == 0 ? 1 : 0;
    $isError = !$this->tugasModel->updateData($id_tugas, [
      'status' => $status
    ]);
    $this->response->setHeader('pesan', $isError ? 'Status gagal diubah' : 'Status berhasil diubah');
    $this->response->setHeader('markstatus', $status ? 'selesai' : 'belum');
    return $this;
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
        session()->setFlashdata('pesan', 'Data tugas gagal diubah.');
        return redirect()->to('/tugas/edit/' . $this->request->getVar('id_tugas'))->withInput();
      }
      $this->tugasModel->updateData($id_tugas, [
        'id_tugas' => $id_tugas,
        'nama_tugas' => $this->request->getVar('nama_tugas'),
        'deskripsi' => $this->request->getVar('deskripsi'),
        'deadline' => $this->request->getVar('deadline'),
        'status' => ($this->request->getVar('status'))? 1 : 0,

      ]);
      $tags = $this->request->getVar('tags');
      $tagsDB = $this->tagsModel->where('id_tugas', $id_tugas)->findAll();
      // $tugasTags = implode(",", array_column($tagsDB, 'nama_tag'));
      $dataTags = [];
      foreach ($tagsDB as $tDB) {
        $this->tagsModel->where('nama_tag', $tDB['nama_tag'])->delete();
      }
      if ($tags != '') {
        $tagsArr = explode(',', $tags);
        $index = 0;
        foreach ($tagsArr as $tag) {
          $dataTags[$index]['id_tugas'] = $id_tugas;
          $dataTags[$index]['nama_tag'] = $tag;
          $index++;
        }
        // if ($tugasTags != $tags) {
        //   foreach ($tagsDB as $tDB) {
        //     $this->tagsModel->where('nama_tag', $tDB['nama_tag'])->delete();
        //   }
        $this->tagsModel->insertBatch($dataTags);
        // }
      }
      session()->setFlashdata('pesan', 'Data tugas berhasil diubah.');
    }

    return redirect()->to('/tugas/index');
  }
}