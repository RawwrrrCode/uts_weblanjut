<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    public function index()
    {
        $model = new ArtikelModel();
        $data['artikels'] = $model->findAll();

        return view('artikel/dashboard', $data); // view sudah diperbaiki ke 'dashboard'
    }

    public function create()
    {
        return view('artikel/create');
    }

    public function store()
    {
        if (!$this->validate([
            'judul' => 'required|min_length[3]',
            'isi' => 'required',
            'status' => 'in_list[publish,draft]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new ArtikelModel();
        $model->save([
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/artikel')->with('message', 'Artikel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->find($id);

        if (!$data['artikel']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan');
        }

        return view('artikel/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'judul' => 'required|min_length[3]',
            'isi' => 'required',
            'status' => 'in_list[publish,draft]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new ArtikelModel();
        $model->update($id, [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/artikel')->with('message', 'Artikel berhasil diperbarui');
    }

    public function delete($id)
    {
        if ($this->request->getMethod(true) !== 'DELETE') {
            return redirect()->back()->with('error', 'Metode tidak diizinkan');
        }

        $model = new ArtikelModel();
        $artikel = $model->find($id);

        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan dengan ID ' . $id);
        }

        $model->delete($id);
        return redirect()->to('/artikel')->with('message', 'Artikel berhasil dihapus');
    }

    
}
