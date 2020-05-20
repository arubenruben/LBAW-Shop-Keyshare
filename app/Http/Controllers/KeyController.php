<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Key;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Policies\KeyPolicy;

class KeyController extends Controller
{
    public function get($keyId)
    {
        if($keyId===NULL)
            return response(json_encode("Key not valid"),400);
        
        $key=Key::findOrFail($keyId);
        
        try {
            $this->authorize('get', $key);
        } catch (AuthorizationException $e) {
            return response("You can't get this key", 401);
        } 
        

        $offer=$key->offer;
        $seller=$offer->seller;
        $product=$offer->product;

        return response(json_encode(['offer'=>$offer,'seller'=>$seller,'product'=>$product]),200);
    }
    
    /*
    public function add($offerId)
    {

    }

    public function update($keyId)
    {

    }
    */

    public function delete($keyId) {
        $key = Key::findOrFail($keyId);

        try {
            $this->authorize('delete', $key);
        } catch (AuthorizationException $e) {
            return response("You can't delete this key", 401);
        }

        $key->delete();

        return response('Success',200);
    }

    public function feedback(Request $request)
    {
        // check if there is no feedback for that key
        $key = Key::findOrFail($request->get('key_id'));
        if($key->feedback != null) {
            return response("You already reviewed this key", 400);
        } else {
            $feedback = Feedback::create([
                'evaluation' => $request->get('feedback'),
                'comment' => $request->get('description'),
                'user_id' => Auth::user()->id,
                'key_id' => $request->get('key_id')
            ]);
            if(!$feedback->save()) return response('Cannot give feedback at this time', 401);

            return response('Success', 200);
        }
    }
}