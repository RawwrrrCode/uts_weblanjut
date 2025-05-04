<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class Home extends BaseController
{

    public function index()
{
    $model = new ArtikelModel();

    // Contoh tanggal, bisa kamu ganti sesuai kebutuhan atau input user
    $startDate = '2025-01-01';
    $endDate = '2026-04-30';

    $data['artikel'] = $model->getPublishedArticlesByDate($startDate, $endDate);

    return view('welcome_message', $data);
}

}
