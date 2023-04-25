<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    protected $auth;

    function __construct()
    {
        $this->auth = auth('api');
    }

    public function mywallet() {
        $user = $this->auth->user();
        $wallet = Wallet::with('coin')->where('user_id', $user->id)->first();

        return $this->response('your wallet address', [
            'name' => $user->name,
            'addr' => $wallet->addr,
            'balance' => $wallet->balance,
            'coin' => $wallet->coin->name
        ]);
    }

    public function create() {
        $user = $this->auth->user();
        $coin = Coin::where('flag', 'MSCOIN')->first();
        $wallet = Wallet::make_wallet($user->email, $user->password);
        $exists_user = Wallet::where('user_id', $user->id)->exists();
        if ($exists_user) {
            return $this->response('Sorry, it looks like you already have a wallet address', status:false);
        } else {
            Wallet::create([
                'addr' => $wallet,
                'balance' => 0,
                'coin_id' => $coin->id,
                'user_id' => $user->id
            ]);
            return $this->response('successfully to create new wallet', [
                'wallet' => $wallet
            ]);
        }
    }
}
