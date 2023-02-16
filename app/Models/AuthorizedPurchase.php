<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizedPurchase extends Model
{
    use HasFactory;

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_id',
        'employee_id',
        'vehicle_id',
        'amount',
        'amount_sold',
        'payment_type',
        'status',
        'name',
        'document_url'
    ];
}
