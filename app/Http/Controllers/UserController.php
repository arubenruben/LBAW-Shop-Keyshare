<?php

namespace App\Http\Controllers;


use http\Client\Curl\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{

    public function show($id) {
        $user = User::findOrFail($id);

        return view('pages.user_profile', ['user' => $user]);
    }

    public function update(UserEditRequest $request) {
        Auth::check();

        if($request->oldPassword != null && $request->newPassword != null) {
            if(Hash::check($request->oldPassword, Auth::user()->password)) {
                Auth::user()->password = Hash::make($request->newPassword);
                try {
                    Auth::user()->save();
                } catch(\Exception $e) {
                    $e->getMessage();
                    return response(json_encode("Error updating profile"), 400);
                }
            } else {
                return response(json_encode("Old password is incorrect"), 400);
            }
        }

        if($request->email != null) {
            Auth::user()->email = $request->email;
            try {
                Auth::user()->save();
            } catch(\Exception $e) {
                $e->getMessage();
                return response(json_encode("Error updating email"), 400);
            }
        }

        if($request->description != null) {
            Auth::user()->description = $request->description;
            try {
                Auth::user()->save();
            } catch(\Exception $e) {
                $e->getMessage();
                return response(json_encode("Error updating description"), 400);
            }
        }

        if($request->birth_date != null) {
            Auth::user()->birth_date = $request->birth_date;
            try {
                Auth::user()->save();
            } catch(\Exception $e) {
                $e->getMessage();
                return response(json_encode("Error updating birth date"), 400);
            }
        }

        if($request->paypal != null) {
            Auth::user()->birth_date = $request->birth_date;
            try {
                Auth::user()->save();
            } catch(\Exception $e) {
                $e->getMessage();
                return response(json_encode("Error updating paypal email"), 400);
            }
        }

        if($request->image != null) {
            Auth::user()->image = $request->image;
            try {
                Auth::user()->save();
            } catch(\Exception $e) {
                $e->getMessage();
                return response(json_encode("Error updating image"), 400);
            }
        }
    }

    public function delete() {

    }

    public function showPurchases($id) {
        $user = User::findOrFail($id);

        try {
            $this->authorize('showPurchases', $user);

            return view('pages.profile', ['user' => $user]);
        } catch (AuthorizationException $e) {
            return response(json_encode(e->getMessage()), 400);
        }

    }

    public function showOffers() {

    }

    public function showReports() {

    }

    public function deleteImage() {

    }
}
