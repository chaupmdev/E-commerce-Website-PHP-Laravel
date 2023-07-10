<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {    
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],
        [
            'username.required' => 'Tên đăng nhập không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.'
        ]);

        $category = DB::table('tbl_category')->limit(12)->get();
        $sale_off = DB::table('tbl_sale_off')
        ->join('tbl_product', 'tbl_sale_off.idProduct', '=', 'tbl_product.idProduct')
        ->join('tbl_product_image', 'tbl_product.idProduct', '=', 'tbl_product_image.idProduct')
        ->where('startTime','<=', date('Y-m-d'), 'and', 'endTime','>=',date('Y-m-d'))
        ->limit(12)
        ->get();
        //
        $account = DB::table('tbl_account')->where('userLogin','=',$request->username)->where('passwordLogin','=',$request->password)->get();
        if(count($account) > 0)
        {
            foreach($account as $value)
                Session::put('hasLogged',$value->idAccount);

            // $cart = DB::table('tbl_cart')
            // ->join('tbl_cart', 'tbl_cart.idSegment', '=', 'tbl_classify_product.idSegment')
            // ->join('tbl_classify_product', 'tbl_classify_product.idProduct', '=', 'tbl_product.idProduct')
            // ->join('tbl_product_image', 'tbl_product_image.idProduct', '=', 'tbl_product.idProduct')
            // ->select(
            //     'tbl_product.idProduct',
            //     'tbl_product.nameProduct',
            //     'tbl_product.priceProduct',
            //     'tbl_product_image.firstImage',
            //     'tbl_cart.quantity',
            //     DB::raw("GROUP_CONCAT(tbl_classify_product.nameSegment SEPARATOR ' | ') AS phan_loai"),
            //     DB::raw("SUM(tbl_classify_product.priceSegment) AS tong_phu_thu")
            // ) 
            // ->groupBy('tbl_product.idProduct')           
            // ->where('tbl_cart.idAccount', '=', '1')
            // ->get();

            $cart = DB::select('SELECT tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,GROUP_CONCAT(tbl_classify_product.nameSegment SEPARATOR " | ") 
            AS phan_loai, SUM(tbl_classify_product.priceSegment) 
            AS tong_phu_thu, tbl_product_image.firstImage, tbl_cart.quantity 
            FROM tbl_product,tbl_cart,tbl_classify_product,tbl_product_image 
            WHERE tbl_cart.idAccount='.Session::get('hasLogged').'
            AND tbl_cart.idSegment = tbl_classify_product.idSegment 
            AND tbl_classify_product.idProduct = tbl_product.idProduct 
            AND tbl_product_image.idProduct = tbl_product.idProduct 
            GROUP BY tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,tbl_product_image.firstImage, tbl_cart.quantity');

            return view('client.home')->with('category',$category)->with('sale_off',$sale_off)->with('flag_session',true)->with('cart',$cart);
        }
        return view('client.home')->with('category',$category)->with('sale_off',$sale_off)->with('flag_session',false);
    }

    public function register(Request $request)
    {    
        $request->validate([
            'registerfullname' => 'required',
            'registeremail' => 'required|email',
            'registerphonenumber' => 'required|max:11',
            'registerusername' => 'required|min:6',
            'registerpassword' => 'required|min:6',
            'registerretypepassword' => 'required'
        ],
        [
            'registerfullname.required' => 'Vui lòng nhập họ và tên đầy đủ.',
            'registeremail.required' => 'Vui lòng nhập địa chỉ email.',
            'registeremail.email' => 'Vui lòng nhập địa chỉ email thực.',
            'registerphonenumber.required' => 'Vui lòng nhập số điện thoại',
            'registerphonenumber.max' => 'Vui lòng nhập số điện thoại dưới 11 chữ số',
            'registerusername.required' => 'Vui lòng nhập tên tài khoản đăng kí',
            'registerusername.min' => 'Tên đăng nhập phải lớn hơn 6 kí tự',
            'registerpassword.required' => 'Vui lòng nhập mật khẩu đăng nhập',
            'registerpassword.min' => 'Mật khẩu đăng nhập phải lớn hơn 6 kí tự',
            'registerretypepassword.required' => 'Vui lòng nhập xác nhận mật khẩu'
        ]);

        DB::insert("INSERT INTO tbl_account VALUES(null,'$request->registerusername','$request->registerpassword','$request->registerfullname','$request->registeremail','$request->registerphonenumber',0,'client')");

        $category = DB::table('tbl_category')->limit(12)->get();
        $sale_off = DB::table('tbl_sale_off')
        ->join('tbl_product', 'tbl_sale_off.idProduct', '=', 'tbl_product.idProduct')
        ->join('tbl_product_image', 'tbl_product.idProduct', '=', 'tbl_product_image.idProduct')
        ->where('startTime','<=', date('Y-m-d'), 'and', 'endTime','>=',date('Y-m-d'))
        ->limit(12)
        ->get();
        //
        return view('client.home')->with('category',$category)->with('sale_off',$sale_off)->with('flag_session',false);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout()
    {
        Session::forget('hasLogged');

        $category = DB::table('tbl_category')->limit(12)->get();
        $sale_off = DB::table('tbl_sale_off')
        ->join('tbl_product', 'tbl_sale_off.idProduct', '=', 'tbl_product.idProduct')
        ->join('tbl_product_image', 'tbl_product.idProduct', '=', 'tbl_product_image.idProduct')
        ->where('startTime','<=', date('Y-m-d'), 'and', 'endTime','>=',date('Y-m-d'))
        ->limit(12)
        ->get();
        
        $flag_session =true;
        if(!session()->has('hasLogged'))
            $flag_session = false;
        // DB::table('tbl_sale_off','tbl_product','tbl_product_image')->limit(12)->get();
        return view('client.home')->with('category',$category)->with('sale_off',$sale_off)->with('flag_session',$flag_session);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
