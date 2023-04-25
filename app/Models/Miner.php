<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miner extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id', 'speed', 'balance', 'job_id'
    ];

    public function user() {
        return $this->hasOne(User::class);
    }
}
