<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choultry extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'address',
        'pin',
        'phone_number',
        'email',
        'pname',
        'user_id'
    ];
}
