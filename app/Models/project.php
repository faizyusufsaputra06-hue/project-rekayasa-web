<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class project extends Model
{
    //
    use Hasfactory;
    
    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'teknologi',
        'image',
        'status',
    ];
    
}
