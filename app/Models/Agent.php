<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;


    protected $fillable = [
        'agent_name',
        'agent_type',
        'ID_NO',
        'address',
    ];

    public function agentBanks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AgentBank::class, 'agent_id');
    }

    public function execution_request_id_issues(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Issue::class,'execution_request_id');
    }

    public function execution_agent_name_id_issues(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Issue::class,'execution_agent_name_id');
    }

    public function execution_agent_against_it_id_issues(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Issue::class,'execution_agent_against_it_id');
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
