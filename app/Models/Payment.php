<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'employee_id',
        'month',
        'year',
    ];

    CONST FORM_VALIDATION_RULES = [
        'month' => 'required',
        'year' => 'required',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
