<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'age',
        'cnic',
        'email',
        'phone',
        'address',
        'profile_picture',
        'pdf_file',
        'department_id',
    ];

    public function subjects()
        {
            return $this->belongsToMany(Subject::class);
        }

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
