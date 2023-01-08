<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Prefecture;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $prefectures = Prefecture::orderBy('id', 'asc')->get();
        return view('order.show')
                ->with('user', auth()->user())
                ->with('prefectures', $prefectures->pluck('name', 'id'))
                ->with('payments', config('payment.list'))
                ->with('product', $product);
    }

    /**
     * 注文　確認画面
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(OrderRequest $request)
    {
        $validated = $request->validated();
        $prefecture = Prefecture::find($validated['prefecture_id']);
        $validated['prefecture'] = $prefecture->name;
        $validated['payment_name'] = config('payment.list.'.$validated['payment']);
        $user = auth()->user();
        $validated['user'] = $user;
        if(!empty($user)) {
            $validated['email'] = $user->email;
            $validated['password'] = '';
            $validated['ibTEcJ8uRTVsKCWrtW7R'] = $user->name;
        }
        return view('order.confirm', $validated);
    }

    /**
     * 注文　完了画面
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function complete(OrderRequest $request)
    {
        $validated = $request->validated();

        $action = $request->get('action');
        if($action == 'back') return redirect('/order/'.$validated['product_id'])->withInput(); // 戻るボタン
        
        $user = auth()->user();
        if(empty($user)) {
            // ハニーポットの回避
            $validated['name'] = $validated['ibTEcJ8uRTVsKCWrtW7R'];
            // パスワードをハッシュ化して登録
            $validated['password'] = Hash::make($validated['password']);
            $user = new User();
            $user->fill($validated)->save();

            // user_idを設定して登録
            $validated['user_id'] = $user->id;
            $profile = new Profile();
            $profile->fill($validated)->save();
        } else {
            $validated['name'] = $user->name;
            $validated['user_id'] = $user->id;
            $profile = Profile::where('user_id', $user->id)->first();
            $profile->fill($validated)->save();
        }

        // 都道府県コードの設定
        $prefecture = Prefecture::find($validated['prefecture_id']);
        // 商品情報
        $product = Product::find($validated['product_id']);
 
        // 注文情報保存
        $order = new Order(); 
        $validated = array_merge($validated, $order->calc(
            $prefecture,
            $product,
            $validated['orders'],
            config('tax.rate')
        ));
        $order->fill($validated)->save();

        // 支払方法
        $payment = config('payment.list.'.$validated['payment']);

        // メール送信
        $user->profile = $profile;
        Mail::to($user->email)
             ->queue(new OrderMail($user, $order, $prefecture->name, $payment));

        return view('order.complete');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
