<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserEditRequest;
use App\Picture;
use App\User;


class UserController extends Controller
{
    public function getUser($username)
    {
        $user = DB::table('users')->select('id')->where('username', '=', $username)->first();

        if ($user != null) return User::findOrFail($user->id);
        else abort(404, 'User doesn\'t exist');
    }

    public function show($username)
    {
        $user = $this->getUser($username);

        if (Auth::check() && Auth::id() == $user->id) {
            return view('pages.user.profile', ['user' => $user, 'isOwner' => True, 'breadcrumbs' =>
                ['User' => route('profile', ['username' => $username]),
                    'Account' => route('profile', ['username' => $username])]]);
        } else {
            return view('pages.user.profile', ['user' => $user, 'isOwner' => false, 'breadcrumbs' =>
                ['User' => route('profile', ['username' => $username]),
                'Account' => route('profile', ['username' => $username])]]);
        }
    }

    public function showPurchases()
    {
        $this->authorize('loggedIn', User::class);
        $user = Auth::user();

        $orders = $user->orders;
        $isBanned = $user->isBanned();

        return view('pages.user.purchases', ['user' => $user, 'orders' => $orders, 'isBanned' => $isBanned, 'isOwner' => true, 'breadcrumbs' =>
            ['User' => route('profile', ['username' => $user->username]),
            'Purchases' => route('userPurchases')]]);
    }

    public function showOffers($username)
    {
        $user = $this->getUser($username);
        $isOwner = Auth::check() && Auth::id() == $user->id;

        $pastOffers = $user->pastOffers;
        $currOffers = $user->activeOffers;

        return view('pages.user.offers', [
            'user' => $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers, 'isOwner' => $isOwner, 'breadcrumbs' =>
                ['User' => route('profile', ['username' => $username]),
                'Offers' => route('userOffers', ['username' => $username])]
        ]);
    }

    public function showReports()
    {
        $this->authorize('loggedIn', User::class);
        $user = Auth::user();

        $myReports = $user->reportsGiven;
        $reportsAgainstMe = $user->reportsReceived;

        return view('pages.user.reports', [
            'user' => $user, 'myReports' => $myReports,
            'reportsAgainstMe' => $reportsAgainstMe, 'isOwner' => true, 'breadcrumbs' =>
                ['User' => route('profile', ['username' => $user->username]),
                'Reports' => route('userReports')]
        ]);
    }

    public function update(UserEditRequest $request)
    {

        $this->authorize('update', User::class);

        //$request = $request->validated();

        if (isset($request->email)) {
            if(Auth::user()->isBanned())
                return response(json_encode(["message" => "Failure", "errors" => ["email" => "You are currently banned"]]));
            Auth::user()->email = $request->email;
        }

        if (isset($request->description)) {
            if(Auth::user()->isBanned())
                return response(json_encode(["message" => "Failure", "errors" => ["description" => "You are currently banned"]]));
            Auth::user()->description = $request->description;
        }
        if (isset($request->oldPassword) && isset($request->newPassword)) {
            if (Hash::check($request->oldPassword, Auth::user()->password)) {
                if(Hash::check($request->newPassword, Auth::user()->password))
                    return response(json_encode(["message" => "Failure", "errors" => ["newPassword" => "New password is equal to the old password, choose another"]]), 400);
                Auth::user()->password = Hash::make($request->newPassword);
            } else {
                return response(json_encode(["message" => "Failure", "errors" => ["oldPassword" => "Old password is incorrect"]]), 400);
            }
        }
        if (isset($request->paypal)) {
            Auth::user()->paypal = $request->paypal;
        }

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureORM = new Picture;
            $username = Auth::user()->username;
            $imgFinal = Image::make($picture->getRealPath());

            $hash = md5($username . now());
            $imgFinal->save('pictures/profile/' . $hash . '.png');

            $pictureORM->url = $hash . '.png';
            $pictureORM->save();

            Auth::user()->picture_id=$pictureORM->id;
        }

        Auth::user()->save();
        return response(json_encode("Success"), 200);
    }

    public function delete()
    {
        $this->authorize('delete', User::class);
        User::destroy(Auth::id());
    }

    public function deleteImage()
    {
        $this->authorize('update', User::class);
        if(Auth::user()->picture->id!=1) Picture::find(Auth::user()->picture->id)->delete();

        return back();
    }
}