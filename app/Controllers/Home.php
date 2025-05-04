<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class Home extends BaseController
{

    public function index()
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->findAll();

        return view('welcome_message', $data);
    }
}
