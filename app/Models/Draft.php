<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    use HasFactory;

    protected $fillable = [
        'draft_NO',
        'customer_id',
        'user_id',
        'document_type',
        'customer_qty',
        'document_qty',
        'document_affiliate',
    ];


    public function UserDraft(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cusotmerdrafts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CustomerDraft::class);
    }

//    public function CustomerDraft(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Customer::class, 'customer_id', 'id');
//    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Gaza')->format('Y-m-d H:i');
    }


    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Gaza')->format('Y-m-d H:i');
    }
}
