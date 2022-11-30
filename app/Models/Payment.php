<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_NO',
        'customer_id',
        'user_id',
        'payment_amount',
        'payment_type',
        'payment_via',
        'notes',
        'currency_type'
    ];


    public function UserPayment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function CustomerPayment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Gaza')->format('Y-m-d H:i');
    }


    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Gaza')->format('Y-m-d H:i');
    }
}
