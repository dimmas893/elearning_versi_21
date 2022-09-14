<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'pertanyaan';

    public function category_soal()
    {
        return $this->belongsTo(Category_soal::class);
    }

    public function option()
    {
        return $this->hasMany(Option::class);
    }
}
