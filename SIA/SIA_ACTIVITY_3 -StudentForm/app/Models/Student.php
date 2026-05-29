<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','age','course','mobile','barangay','emergency_contact',
        'gender','guardian_name','guardian_contact','notes'
    ];
}