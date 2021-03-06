<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name','detail',
    ];
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function courses()
    {
        return $this->morphToMany(Course::class, 'courseable');
    }
    protected $casts = [
       
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
