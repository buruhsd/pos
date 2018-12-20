<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $table = 'ref_gambar';
    protected $fillable = ['nama', 'ref_produk_id', 'gambar'];
}
