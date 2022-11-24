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
        'execution_request_id',
        'execution_agent_name_id',
        'execution_agent_against_it_id',
        'customer_qty',
        'notes',
    ];


    public function UserIssue(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function execution_request_idIssue(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Agent::class, 'execution_request_id', 'id');
    }

    public function execution_agent_name_idIssue(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Agent::class, 'execution_agent_name_id', 'id');
    }

    public function execution_agent_against_it_idIssue(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Agent::class, 'execution_agent_against_it_id', 'id');
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
