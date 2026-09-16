<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'department_id', 'position_id', 'address', 'pob', 'dob', 'gender', 'religion', 'phone_number', 'salary', 'start_date', 'end_date', 'status'])]
class Employee extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
