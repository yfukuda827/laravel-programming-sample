<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostcodeRequest;
use App\Models\Postcode;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with('product_category')->orderBy('id', 'desc')->limit(6)->get();
        return view('home')->with('products', $products);
    }

    /**
     * Company 会社情報表示
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function company()
    {
        return view('pages.company');
    }

    /**
     * 郵便番号から住所を返却
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json 
     */
    public function postcode(PostcodeRequest $request) {
        $inPostcode = $request->input('postcode');
        $postcode = Postcode::where('postcode', $inPostcode)->first(); 
        if(empty($postcode)) {
            abort(404);
        }
        return response()->json([
            'prefecture_id' => $postcode->prefecture_id,
            'address' => $postcode->address,
        ]);
    }
}
