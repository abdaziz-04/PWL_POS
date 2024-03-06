<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'm_user'; // Mendefinisikan nama tabel
    protected $primarykey = 'user_id'; // Mendefinisikan primary key dari yang digunakan
}