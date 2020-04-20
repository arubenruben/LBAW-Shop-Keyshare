<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserEditRequest;

use App\User;

class UserController extends Controller
{
    public function getUser($username){
        $user = DB::table('regular_user')->select('id')->where('username', '=', $username)->first();
        if($user != null)
            return User::findOrFail($user->id);

        else
            return abort(404);;
    }

    public function show($username)
    {

        $user = $this->getUser($username);

        try {
            //$this->authorize('ownUser', $user->id);
        } catch (AuthorizationException $e) {
            return view('pages.user.profile', ['user' => $user, 'isOwner' => false]);
        }

        return view('pages.user.profile', ['user' => $user, 'isOwner' => true]);
    }

    public function showPurchases()
    {
        try {
          //  $this->authorize('loggedIn');
        } catch (AuthorizationException $e) {
            return response(json_encode($e->getMessage()), 400);
        }

        $orders = Auth::user()->orders()->sortBy('date');
        $isBanned = Auth::user()->banned();

        return view('pages.user.purchases', ['orders' => $orders, 'isBanned' => $isBanned]);
    }

    public function showOffers($username)
    {
        $user = $this->getUser($username);
        $isOwner = true;

        try {
           // $this->authorize('edit', $user->id);
        } catch (AuthorizationException $e) {
            $isOwner = false;
        }

        $pastOffers = $user->pastOffers()->getResults();
        $currOffers = $user->activeOffers()->getResults();

        return view('pages.user.offers', ['user' => $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers, 'isOwner' => $isOwner]);
    }

    public function showReports($username)
    {

        $user = $this->getUser($username);
        try {
           // $this->authorize('loggedIn');
        } catch (AuthorizationException $e) {
            return response(json_encode($e->getMessage()), 400);
        }

        $myReports = $user->reportee()->getResults();
        $reportsAgainstMe = $user->reporter()->getResults();
        $isBanned = $user->banned();

        return view('pages.user.reports', ['user' => $user, 'myReports' => $myReports, 'reportsAgainstMe' => $reportsAgainstMe, 'isBanned' => $isBanned]);
    }

    public function update(UserEditRequest $request)
    {
        try {
         //   $this->authorize('update');
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't edit this profile"), 400);
        }

        $request = $request->validated();

        if (isset($request->oldPassword) && isset($request->newPassword)) {
            if (Hash::check($request->oldPassword, Auth::user()->password)) {
                Auth::user()->password = Hash::make($request->newPassword);
            } else {
                return response(json_encode("Old password is incorrect"), 400);
            }
        }

        if (isset($request->email)) {
            Auth::user()->email = $request->email;
        }

        if (isset($request->description)) {
            Auth::user()->description = $request->description;
        }

        if (isset($request->birth_date)) {
            Auth::user()->birth_date = $request->birth_date;
        }

        if (isset($request->paypal)) {
            Auth::user()->birth_date = $request->birth_date;
        }

        if (isset($request->image)) {
            Auth::user()->image = $request->image;
        }

        Auth::user()->save();
    }

    public function delete()
    {
        try {
            $this->authorize('delete');
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

        Auth::user()->image = '0';
        Auth::user()->save();
    }


}
