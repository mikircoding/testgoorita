<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'published_date',
        'image',
    ];

    // public function getPublishedDateAttribute($published_date)
    // {
    //     $value = \Carbon\Carbon::parse($published_date);
    //     $parse = $value->locale('id');
    //     return $parse->translatedFormat('l, d F Y');
    // }
}
