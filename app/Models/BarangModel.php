<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangModel extends Model
{
    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';
    public $timestamps = false;

    protected $fillable = ['barang_id', 'barang_kode', 'barang_nama', 'harga_jual'];

    protected $attributes = [
        'kategori_id' => 5,
        'harga_beli' => 50000,
        'harga_jual' => 55000,

    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id')->select(['kategori_id', 'kategori_nama']);
    }
}
