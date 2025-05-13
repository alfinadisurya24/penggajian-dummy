<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'nip',
        'email',
        'position',
        'phone',
        'address',
        'gender',
        'birth_date',
        'salary',
    ];

    CONST FORM_VALIDATION_RULES = [
        'name' => 'required',
        'nip' => 'required',
        'email' => 'required|email',
        'position' => 'required',
        'phone' => 'required',
        'address' => 'nullable',
        'gender' => 'required',
        'birth_date' => 'required',
        'salary' => 'required',
    ];
}
