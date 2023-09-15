<?php

namespace App\Models;

use Carbon\Carbon;
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
        'approved_by',
        'pump',
        'pump_side',
        'nozzle',
        'receipt_image_url',
        'sold_by',
        'rewards_balance',
        'status',
        'reason',
        'organization_id',
        'litres_sold',
        'bulk_rewards',
        'sales_type'
    ];


    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->format('d-m-Y H:i:s');
    }

    public function getApprovedDateAttribute($date) {
        return Carbon::parse($date)->format('d-m-Y H:i:s');
    }
}
