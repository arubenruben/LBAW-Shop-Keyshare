<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserEditRequest;
use App\Policies\UserPolicy;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser($username){
        $user = DB::table('users')->select('id')->where('username', '=', $username)->first();

        if($user != null)
            return User::findOrFail($user->id);
        else
            abort(404, 'User doesn\'t exist');
    }

    public function show($username) {
        $user = $this->getUser($username); 

        if(Auth::check() && Auth::id() == $user->id){
            return view('pages.user.profile', ['user' => $user, 'isOwner' => True, 'pages' => array('User'),'links'=>array(url('/user/'.Auth::user()->username))]);
        } else{
            return view('pages.user.profile', ['user' => $user, 'isOwner' => false, 'pages'=>array('User'),'links'=>array(url('/user/'.$username))]);
        }

    }

    public function showPurchases() {
        try {
          $this->authorize('loggedIn',User::class);
        } catch (AuthorizationException $e) {
            return response(json_encode($e->getMessage()), 400);
        }

        $user = Auth::user();

        $orders = $user->orders;
        $isBanned = $user->banned();

        return view('pages.user.purchases', ['user' => $user, 'orders' => $orders, 'isBanned' => $isBanned, 'isOwner' => true, 'pages' =>array('User', 'Purchases'),'links'=>array(url('/user/'.$user->username),url('/user/purchases'))]);
    }

    public function showOffers($username) {
        $user = $this->getUser($username);
        $isOwner = Auth::check() && Auth::id() == $user->id;

       
        $pastOffers = $user->pastOffers;
        $currOffers = $user->activeOffers;

        return view('pages.user.offers', ['user'=> $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers, 'isOwner' => $isOwner,'pages'=>array('User', 'Offers'),'links'=>array(url('/user/'.$username), url('/user/'.$username.'/offers'))]);
    }

    public function showReports() {
        try {
           $this->authorize('loggedIn',User::class);
        } catch (AuthorizationException $e){
            return response(json_encode($e->getMessage()), 400);
        }

        $user = Auth::user();

        $myReports = $user->reportsGiven;
        $reportsAgainstMe = $user->reportsReceived;

        return view('pages.user.reports', ['user' => $user, 'myReports' => $myReports,
            'reportsAgainstMe' => $reportsAgainstMe, 'isOwner' => true, 'pages'=>array('User','Reports'),
            'links'=>array(url('/user/'.$user->username),url('/user/reports'))]);
    }

    public function update(UserEditRequest $request) {
        try {
          $this->authorize('update',User::class);
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

        if (isset($request->image)) {
            Auth::user()->image = $request->image;
        }
        
        Auth::user()->save();

        return response(json_encode("Success"), 200);
        
    }

    public function delete() {
        try {
            $this->authorize('delete',User::class);
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't delete this profile"), 400);
        }

        User::destroy(Auth::id());
    }

    public function deleteImage() {
        try {
            $this->authorize('update');
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't edit this profile"), 400);
        }

        Auth::user()->image = '1';
        Auth::user()->save();
    }
}
