<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_NO',
        'user_id',
        'court_name',
        'case_number',
        'case_amount',
        'execution_request',
        'execution_agent_name',
        'execution_agent_against_it',
        'customer_qty',
        'notes',
    ];


    public function UserIssue(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cusotmerissues(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CustomerIssue::class,'issue_id');
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
