<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $casts = [
        'created_at' => 'datetime:m/d/Y',
        'updated_at' => 'datetime:m/d/Y',
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'id_number',
        'email',
        'gender',
        'type',
        'rewards',
        'enrolled_by',
        'organization_id',
        'custom_reward_type',
        'status',
    ];

    public  function discounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Discount::class,'customer_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

}
