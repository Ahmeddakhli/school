<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courseable extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'age','course_id','courseable_id','courseable_type'
    ];
}
