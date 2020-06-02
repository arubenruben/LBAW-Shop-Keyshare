<?php

namespace App\Http\Controllers;

use App\Key;
use App\Feedback;
use App\Http\Requests\FeedbackAddRequest;
use App\Http\Requests\ReportAddRequest;
use Illuminate\Support\Facades\Auth;
use App\Report;

class KeyController extends Controller
{
    public function get($id)
    {
        $key = Key::findOrFail($id);
        $this->authorize('get', $key);


        $offer = $key->offer;
        $seller = $offer->seller;
        $product = $offer->product;
        $feedback = $key->feedback;

        return response(json_encode(['offer' => $offer, 'seller' => $seller, 'product' => $product, 'feedback' => $feedback]), 200);
    }

    public function delete($id)
    {
        $key = Key::findOrFail($id);
        $this->authorize('delete', $key);

        if(!$key->delete()) return response('Cannot delete key at this time', 401);;

        return response('Success', 200);
    }

    public function feedback(FeedbackAddRequest $request)
    {
        $key = Key::findOrFail($request->get('key'));
        $this->authorize('submitFeedback', $key);

        $feedback = Feedback::create([
            'evaluation' => $request->get('evaluation'),
            'comment' => $request->get('comment'),
            'user_id' => Auth::user()->id,
            'key_id' => $key->id
        ]);

        if (!$feedback->save()) return response('Cannot give feedback at this time', 401);

        return response('Success', 200);
    }

    public function report(ReportAddRequest $request)
    {
        $key = Key::findOrFail($request->get('key'));

        if ($key->report != null)
            return response("You already reported this key", 400);

        $report = Report::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'key_id' => $key->id,
            'reporter_id' => Auth::id(),
            'reported_id' => $key->offer->seller->id
        ]);

        if (!$report->save()) return response('Cannot give feedback at this time', 401);

        return response('Success', 200);
    }
}
