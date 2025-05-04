<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    public function index()
    {
        // Panggil model
        $model = new ArtikelModel();

        // Ambil semua data artikel dari database
        $data['artikel'] = $model->findAll();

        // Tampilkan view dengan data
        return view('artikel/index', $data);
    }
    public function create()
{
    return view('artikel/create');
}

public function store()
{
    $model = new ArtikelModel();

    $data = [
        'judul'            => $this->request->getPost('judul'),
        'slug'             => url_title($this->request->getPost('judul'), '-', true),
        'isi'              => $this->request->getPost('isi'),
        'tanggal_publikasi'=> $this->request->getPost('tanggal_publikasi'),
        'status'           => $this->request->getPost('status'),
        'author'           => $this->request->getPost('author'),
        'meta_deskripsi'   => $this->request->getPost('meta_deskripsi'),
        'kata_kunci'       => $this->request->getPost('kata_kunci'),
    ];

    $model->insert($data);

    return redirect()->to('/artikel')->with('message', 'Artikel berhasil ditambahkan');
}

public function getArtikel($id)
{
    $model = new ArtikelModel();
    $artikel = $model->find($id);

    if (!$artikel) {
        return $this->response->setStatusCode(404)->setJSON(['error' => 'Artikel tidak ditemukan']);
    }

    return $this->response->setJSON($artikel);
}

public function edit($id)
{
    $model = new \App\Models\ArtikelModel();
    $artikel = $model->find($id);

    if (!$artikel) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan dengan ID ' . $id);
    }

    return view('artikel/edit', ['artikel' => $artikel]);
}

public function update($id)
{
    $model = new \App\Models\ArtikelModel();

    $data = [
        'judul'            => $this->request->getPost('judul'),
        'slug'             => url_title($this->request->getPost('judul'), '-', true),
        'isi'              => $this->request->getPost('isi'),
        'tanggal_publikasi'=> $this->request->getPost('tanggal_publikasi'),
        'status'           => $this->request->getPost('status'),
        'author'           => $this->request->getPost('author'),
        'meta_deskripsi'   => $this->request->getPost('meta_deskripsi'),
        'kata_kunci'       => $this->request->getPost('kata_kunci'),
    ];

    $model->update($id, $data);

    return redirect()->to('/artikel')->with('message', 'Artikel berhasil diperbarui');
}

public function delete($id)
{
    $model = new \App\Models\ArtikelModel();

    // Cek apakah artikel ada
    $artikel = $model->find($id);
    if (!$artikel) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan dengan ID ' . $id);
    }

    // Hapus artikel
    $model->delete($id);

    return redirect()->to('/artikel')->with('message', 'Artikel berhasil dihapus');
}


}
