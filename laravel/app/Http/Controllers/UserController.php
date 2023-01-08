<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;
use App\Mail\EditPasswordMail;
use App\Models\Order;
use App\Models\Prefecture;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * mypage 
     *
     * @return \Illuminate\Http\Response
     */
    public function mypage()
    {
        $user = auth()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $prefecture = Prefecture::find($profile->prefecture_id);
        $orders = Order::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        return view('mypage')
                ->with('user', $user)
                ->with('prefecture', $prefecture->name)
                ->with('profile', $profile)
                ->with('orders', $orders);
    }

    /**
     * show edit password
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditPassword()
    {
        return view('password.edit');
    }

    /**
     * complete edit password 
     *
     * @param EditPasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function completeEditPassword(EditPasswordRequest $request)
    {
        $user = auth()->user(); 
        $validated = $request->validated();
        $newUser = User::find($user->id);

        if (!Hash::check($validated['password'], $newUser->password)) {
            return redirect('/mypage/edit-password')
                        ->withErrors(['password' => '正しいパスワードを指定してください。'])
                        ->withInput();
        }

        $newUser->password = Hash::make($validated['new_password']);
        $newUser->save();

        Mail::to($user->email)
            ->queue(new EditPasswordMail($newUser->name));

        return redirect('/mypage')->with('message', 'パスワードを変更しました。');
    }
}
