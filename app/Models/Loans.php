<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Repayments;

class Loans extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'duration',
        'repayment_frequency',
        'interest_rate',
        'arrangement_fee',
        'status',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function repayments()
    {
        return $this->hasOne(Repayments::class);
    }

}
