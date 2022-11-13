<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'account_number',
        'account_limit',
        'account_balance',
        'limit_utilized',
        'account_type',
        'discount',
        'corporate_status'
    ];
}
