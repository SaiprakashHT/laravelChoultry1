<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outward extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'vendor_name',
        'vendor_phone',
        'description',
        'amount',
    ];
}
