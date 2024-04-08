<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = [
        'transfers',
        'deposits',
        'withdrawals',
        'user_id',
        'email',
    ];
    use HasFactory;
}
