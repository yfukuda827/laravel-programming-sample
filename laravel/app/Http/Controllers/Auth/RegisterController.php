<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Mail\RegisterUserMail;
use App\Models\Prefecture;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }

    /**
     * 会員登録画面表示
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $prefectures = Prefecture::orderBy('id', 'asc')->get();
        return view('register.show')->with('prefectures', $prefectures->pluck('name', 'id'));
    }

    /**
     * 会員登録　確認画面
     *
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $prefecture = Prefecture::find($validated['prefecture_id']);
        $validated['prefecture'] = $prefecture->name;
        return view('register.confirm', $validated);
    }

    /**
     * 会員登録　完了画面
     *
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function complete(RegisterUserRequest $request)
    {
        $action = $request->get('action');
        if($action == 'back') return redirect('/register')->withInput(); // 戻るボタン

        $validated = $request->validated();
        
        // ハニーポットの回避
        $validated['name'] = $validated['RcyEjhgrjvQ9brh8aHQW'];
        // パスワードをハッシュ化して登録
        $validated['password'] = Hash::make($validated['password']);
        $user = new User();
        $user->fill($validated)->save();

        // user_idを設定して登録
        $validated['user_id'] = $user->id;
        $profile = new Profile();
        $profile->fill($validated)->save();

        // 都道府県コードの設定
        $prefecture = Prefecture::find($validated['prefecture_id']);
 
        // メール送信
        $user->profile = $profile;
        Mail::to($user->email)
            ->queue(new RegisterUserMail($user, $prefecture->name));

        return view('register.complete');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
