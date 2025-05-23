<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table            = 'artikel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'judul',
        'slug',
        'isi',
        'tanggal_publikasi',
        'status',
        'author',
        'meta_deskripsi',
        'kata_kunci',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $protectFields    = true;
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Fungsi untuk mengambil artikel dengan status publish dan rentang tanggal publikasi
    public function getPublishedArticlesByDate($startDate, $endDate)
    {
        return $this->where('status', 'publish')
                    ->where('tanggal_publikasi >=', $startDate)
                    ->where('tanggal_publikasi <=', $endDate)
                    ->findAll();
    }

    public function updateStatus($id, $status)
{
    return $this->update($id, ['status' => $status]);
}

}
