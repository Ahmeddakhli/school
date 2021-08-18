<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name','detail',
    ];
    public function students()
    {
        return $this->morphedByMany(Student::class, 'courseable');
    }
    public function classrooms()
    {
        return $this->morphedByMany(Classroom::class, 'courseable');
    }
    protected $casts = [
       
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
