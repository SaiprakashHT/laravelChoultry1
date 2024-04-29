<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'booking_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'customer_gst',
        'bill_no',
        'paid',
        'paid_date_time'
    ];
}
