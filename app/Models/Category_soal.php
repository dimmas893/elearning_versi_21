<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_soal extends Model
{
    use HasFactory;
    protected $table = 'category_soal';
    protected $fillable = ['name'];
}
