<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payed_by',
        'amount_paid',
        'reference_number',
        'payment_mode',
        'payment_date',
        'payment_status',
        'organization_id',
        'account_type'

    ];
}
