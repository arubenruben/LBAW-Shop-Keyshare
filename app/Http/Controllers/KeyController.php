<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeyController extends Controller
{
    public function get($offerId)
    {

    }

    public function add($offerId)
    {

    }

    public function update($keyId)
    {

    }

    public function delete($keyId)
    {

    }

    public function feedback(Request $request)
    {
        // check if there is no feedback for that key
        $key = Key::findOrFail($request->get('key_id'));
        if($key->feedback != null) {
            return response("You already have reviewed this key");
        } else {
            $feedback = Feedback::create([
                'evaluation' => $request->get('feedback'),
                'comment' => $request->get('description'),
                'user_id' => Auth::user()->id,
                'key_id' => $request->get('key_id')
            ]);
            $feedback->save();
            return response("Success");
        }
    }

    public function report($keyId)
    {

    }
}