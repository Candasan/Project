<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TambahBerita extends Model
{
    protected $table = "tambahberita";
    protected $primarykey = "id";
    protected $fillable = ['id', 'judul', 'isi'];
}
