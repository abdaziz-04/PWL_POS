<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class SalesDetailModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan_detail'; //mendefiniskan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'penjualan_id'; //mendefiniskan primary key dari tabel yang digunakan

    protected $fillable = ['penjualan_id','barang_id','harga','jumlah'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
