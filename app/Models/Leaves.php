<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'leave_type', 'start_date', 'end_date', 'reason', 'status'])]
class Leaves extends Model
{
    //
}
