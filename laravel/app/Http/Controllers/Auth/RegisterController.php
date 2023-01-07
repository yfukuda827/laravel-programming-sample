<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Mail\RegisterUserMail;
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
     */
    public function show()
    {
        return view('register.show')->with('prefectures', config('prefectures'));
    }

    public function confirm(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $validated['prefecture'] = config('prefectures.'.$validated['prefecture_id']);
        return view('register.confirm', $validated);
    }

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
        $prefecture = config('prefectures.'.$profile->prefecture_id);

        // メール送信
        $user->profile = $profile;
        Mail::to($user->email)
            ->queue(new RegisterUserMail($user, $prefecture));

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

    /**
     * 管理者ログイン用
     */
    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['authgroup' => 'admin']);
    }

    public function registerAdmin(Request $request)
    {
        $this->adminValidator($request->all())->validate();

        event(new Registered($user = $this->createAdmin($request->all())));

        Auth::guard('admin')->login($user);

        if ($response = $this->registeredAdmin($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect(route('admin-home'));
    }

    protected function createAdmin(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registeredAdmin(Request $request, $user)
    {
        //
    }
}
