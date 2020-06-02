<?php

namespace App\Http\Controllers;

use App\BanAppeal;
use App\Http\Requests\BanAppealRequest;
use Illuminate\Support\Facades\Auth;

class BanAppealController extends Controller {
    public function appeal(BanAppealRequest $request) {
        BanAppeal::create([
            'id' => Auth::id(),
            'ban_appeal' => $request->get('appeal')
        ])->save();

        return response()->json(['message' => 'Successfully submitted ban appeal']);
    }
}
