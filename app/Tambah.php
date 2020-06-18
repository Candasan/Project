<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tambah extends Model
{
    protected $table = "tambah";
    protected $primarykey = "id";
    protected $fillable = ['id', 'judul', 'isi'];
}
