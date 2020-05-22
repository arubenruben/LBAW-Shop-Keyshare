<?php

namespace App\Http\Controllers;

use App\Key;
use App\Feedback;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Policies\KeyPolicy;
use App\Http\Requests\FeedbackAddRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KeyController extends Controller
{
    public function get($id)
    {
        $key = Key::findOrFail($id);
        
        try {
            $this->authorize('get', $key);
        } catch (AuthorizationException $e) {
            return response("You can't get this key", 401);
        } 

        $offer = $key->offer;
        $seller = $offer->seller;
        $product = $offer->product;
        $feedback = $key->feedback;

        return response(json_encode(['offer'=>$offer,'seller'=>$seller,'product'=>$product,'feedback'=>$feedback]),200);
    }
    
    public function add(FeedbackAddRequest $request)
    {
        $key = Key::findOrFail($request->get('key'));

        try {
            $this->authorize('submitFeedback', $key);
        } catch (AuthorizationException $e) {
            return response("You can't get this key", 401);
        }

        $feedback = Feedback::create([
            'evaluation' => $request->get('evaluation'),
            'comment' => $request->get('comment'),
            'user_id' => Auth::user()->id,
            'key_id' => $key->id
        ]);

        if(!$feedback->save()) return response('Cannot give feedback at this time', 401);

        return response('Success', 200);
    }
    
    /*
    public function update($keyId)
    {

    }
    */

    public function delete($id) {
        $key = Key::findOrFail($id);

        try {
            $this->authorize('delete', $key);
        } catch (AuthorizationException $e) {
            return response("You can't delete this key", 401);
        }

        $key->delete();

        return response('Success',200);
    }

    public function report(Request $request)
    {
        $key = Key::findOrFail($request->get('key_id'));
        if($key->report != null) {
            return response("You already reported this key", 400);
        } else {
            $report = Report::create([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'key_id' => $key->id,
                'reporter_id' =>Auth::user()->id,
                'reported_id' => $key->offer->seller
            ]);

            if(!$report->save()) return response('Cannot give feedback at this time', 401);

            return response('Success', 200);
        }
    }
}