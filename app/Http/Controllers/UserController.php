<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use App\Picture;
use App\User;
use Image;


class UserController extends Controller
{
    public function getUser($username)
    {
        $user = DB::table('users')->select('id')->where('username', '=', $username)->first();

        if ($user != null)
            return User::findOrFail($user->id);
        else
            abort(404, 'User doesn\'t exist');
    }

    public function show($username)
    {
        $user = $this->getUser($username);

        if (Auth::check() && Auth::id() == $user->id) {
            return view('pages.user.profile', ['user' => $user, 'isOwner' => True, 'breadcrumbs' => ['User' => url('/user/' . $username)]]);
        } else {
            return view('pages.user.profile', ['user' => $user, 'isOwner' => false, 'breadcrumbs' => ['User' => url('/user/' . $username)]]);
        }
    }

    public function showPurchases()
    {
        try {
            $this->authorize('loggedIn', User::class);
        } catch (AuthorizationException $e) {
            return response(json_encode($e->getMessage()), 400);
        }

        $user = Auth::user();

        $orders = $user->orders;
        $isBanned = $user->banned();

        return view('pages.user.purchases', ['user' => $user, 'orders' => $orders, 'isBanned' => $isBanned, 'isOwner' => true, 'breadcrumbs' => ['User' => url('/user/' . $user->username), 'Purchases' => url('/user/purchases')]]);
    }

    public function showOffers($username)
    {
        $user = $this->getUser($username);
        $isOwner = Auth::check() && Auth::id() == $user->id;

        $pastOffers = $user->pastOffers;
        $currOffers = $user->activeOffers;

        return view('pages.user.offers', [
            'user' => $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers, 'isOwner' => $isOwner, 'breadcrumbs' => ['User' => url('/user/' . $username), 'Offers' => url('/user/' . $username . '/offers')]
        ]);
    }

    public function showReports()
    {
        try {
            $this->authorize('loggedIn', User::class);
        } catch (AuthorizationException $e) {
            return response(json_encode($e->getMessage()), 400);
        }

        $user = Auth::user();

        $myReports = $user->reportsGiven;
        $reportsAgainstMe = $user->reportsReceived;

        return view('pages.user.reports', [
            'user' => $user, 'myReports' => $myReports,
            'reportsAgainstMe' => $reportsAgainstMe, 'isOwner' => true,
            'breadcrumbs' => ['User' => url('/user/' . $user->username), 'Reports' => url('/user/reports')]
        ]);
    }

    public function update(UserEditRequest $request)
    {
        try {
            $this->authorize('update', User::class);
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't edit this profile"), 400);
        }

        //$request = $request->validated();

        if (isset($request->email)) {
            Auth::user()->email = $request->email;
        }

        if (isset($request->description)) {
            Auth::user()->description = $request->description;
        }
        if (isset($request->oldPassword) && isset($request->newPassword)) {
            if (Hash::check($request->oldPassword, Auth::user()->password)) {
                Auth::user()->password = Hash::make($request->newPassword);
            } else {
                return response(json_encode("Old password is incorrect"), 400);
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

        return response(json_encode("success"), 200);
    }

    public function delete()
    {
        try {
            $this->authorize('delete', User::class);
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't delete this profile"), 400);
        }

        User::destroy(Auth::id());
    }

    public function deleteImage()
    {
        try {
            $this->authorize('update');
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't edit this profile"), 400);
        }

        Auth::user()->picture = '1';
        Auth::user()->save();
    }
}