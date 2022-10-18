<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_NO',
        'full_name',
        'ID_NO',
        'phone_NO',
        'region',
        'address',
        'reserve_phone_NO',
        'date_of_birth',
        'marital_status',
        'number_of_children',
        'job',
        'salary',
        'bank_name',
        'bank_branch',
        'bank_account_NO',
        'status',
        'created_by',
        'updated_by',
        'account',
    ];

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function UserCustomer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function UserUpdateCustomer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
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
