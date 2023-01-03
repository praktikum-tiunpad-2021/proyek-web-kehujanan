<?php

namespace App\Controllers;

use App\Models\TagsModel;

class Tags extends BaseController
{
  public function index()
  {
    $model = new TagsModel();
    $data = [];
    $tag = explode(',', 'suku,negara,bangsa');

    $index = 0;
    foreach ($tag as $taag) {
      $data[$index]['id_tugas'] = 19;
      $data[$index]['nama_tag'] = $taag;
      $index++;
    }
    $model->insertBatch($data);

    return view('tes_tag', $data);
  }
}