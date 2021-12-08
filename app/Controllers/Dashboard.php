<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'activeBtn' => 'index',
            'idTugas' => ""
        ];
        return view('/dashboard', $data);
    }
    public function create()
    {
        $data = [
            'activeBtn' => 'create',
            'idTugas' => ""
        ];
        return view('/dashboard', $data);
    }
    public function lorem30(){
        $data = [
            'activeBtn' => 'lorem30',
            'idTugas' => ""
        ];
        return view('/dashboard', $data);
    }
    public function profile(){
        $data = [
            'activeBtn' => 'profile',
            'idTugas' => ""
        ];
        return view('/dashboard', $data);
    }
    public function edit($idTugas){
        $data = [
            'activeBtn' => 'edit',
            'idTugas' => "".$idTugas
        ];
        return view('/dashboard', $data);
    }
}
