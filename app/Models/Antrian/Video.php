<?php

namespace App\Models\Antrian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = "videos";
    protected $guarded = []; 

    protected $fillable = [
        'path',
    ];
}
