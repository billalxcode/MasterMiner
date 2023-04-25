<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'addr', 'balance', 'coin_id', 'user_id'
    ];

    public static function make_wallet($email, $password) {
        $email_hash = sha1($email, true);
        $password_hash = sha1($password, true);
        $sha1 = sha1(base64_encode($email_hash) . base64_encode($password_hash), true);
        $sha256 = hash('sha256', $sha1);
        return 'mm' . $sha256;
    }

    public function user() {
        return $this->hasOne(User::class);
    }

    public function coin() {
        return $this->hasOne(Coin::class, 'id', 'coin_id');
    }
}
