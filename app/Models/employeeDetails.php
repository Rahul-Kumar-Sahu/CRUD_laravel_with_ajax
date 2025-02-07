<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employeeDetails extends Model
{
    //
    protected $table = 'employee_details';

    protected $fillable = [
        'emp_name',
        'emp_email',
        'emp_phone',
        'emp_address',
        'emp_department',
        'emp_joining_date',
        'emp_designation'
    ];
}
