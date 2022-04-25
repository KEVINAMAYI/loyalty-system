<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'vehicle_registration',
        'product',
        'rewards_used',
        'rewards_awarded',
        'amount_payable',
        'amount_paid',
        'image_url',
        'pump_image_url',
        'receipt_image_url'  
    ];
}
