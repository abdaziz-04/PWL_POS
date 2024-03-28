<?php

namespace App\Models;

use App\Models\LevelModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserModel extends Model
{
    use HasFactory;
    protected $table = 'm_user'; // Mendefinisikan nama tabel
    public $timestamps = false;
    protected $primaryKey = 'user_id'; // Mendefinisikan primary key dari yang digunakan

    // ! Jobsheet 4
    protected $fillable = ['user_id', 'level_id', 'username', 'nama', 'password'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
