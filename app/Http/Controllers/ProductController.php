<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_product)
    {
        //
        
        $category = DB::table('tbl_category')->limit(12)->get();
        $product = DB::table('tbl_product')
        ->join('tbl_country', 'tbl_country.idCountry', '=', 'tbl_product.idCountry')
        ->join('tbl_product_image', 'tbl_product.idProduct', '=', 'tbl_product_image.idProduct')
        ->join('tbl_shop_of_seller', 'tbl_shop_of_seller.idShop', '=', 'tbl_product.idShop')
        ->where('tbl_product.idProduct', '=', $id_product)
        ->get();

        $classify = DB::table('tbl_classify_product')
        ->select('codeClassify')
        ->groupBy('codeClassify')
        ->where('idProduct', '=', $id_product)
        ->get();

        $segment = DB::table('tbl_classify_product')
        ->where('tbl_classify_product.idProduct', '=', $id_product)
        ->get();

        $rate = DB::table('tbl_product_rate')
        ->join('tbl_account', 'tbl_account.idAccount', '=', 'tbl_product_rate.idAccount')
        ->where('tbl_product_rate.idProduct', '=', $id_product)
        ->get();

        $saleoff = DB::table('tbl_sale_off')
        ->where('tbl_sale_off.idProduct', '=', $id_product)
        ->where('startTime','<=', date('Y-m-d'), 'and', 'endTime','>=',date('Y-m-d'))->get();

        $follow = DB::table('tbl_shop_of_seller')
        ->leftJoin('tbl_shop_follow', 'tbl_shop_follow.idShop', '=', 'tbl_shop_of_seller.idShop')
        ->select(
            'tbl_shop_of_seller.idShop',
            DB::raw('COALESCE(COUNT(*), -1) AS follow')
        )
        ->groupBy('tbl_shop_of_seller.idShop')->get();

        $flag_session =false;
        if(session()->has('hasLogged'))
        {
            $flag_session =true;
            $cart = DB::select('SELECT tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,GROUP_CONCAT(tbl_classify_product.nameSegment SEPARATOR " | ") 
            AS phan_loai, SUM(tbl_classify_product.priceSegment) 
            AS tong_phu_thu, tbl_product_image.firstImage, tbl_cart.quantity 
            FROM tbl_product,tbl_cart,tbl_classify_product,tbl_product_image 
            WHERE tbl_cart.idAccount='.Session::get('hasLogged').'
            AND tbl_cart.idSegment = tbl_classify_product.idSegment 
            AND tbl_classify_product.idProduct = tbl_product.idProduct 
            AND tbl_product_image.idProduct = tbl_product.idProduct 
            GROUP BY tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,tbl_product_image.firstImage, tbl_cart.quantity');
            return view('client.detailproduct')->with('category',$category)->with('product',$product)->with('classify',$classify)->with('segment',$segment)->with('rate',$rate)->with('follow',$follow)->with('saleoff',$saleoff)->with('flag_session',$flag_session)->with('cart',$cart);
        }

        return view('client.detailproduct')->with('category',$category)->with('product',$product)->with('classify',$classify)->with('segment',$segment)->with('rate',$rate)->with('follow',$follow)->with('saleoff',$saleoff)->with('flag_session',$flag_session);
    }

    public function show_all()
    {
        //
        $product_all = DB::table('tbl_product')
        ->join('tbl_product_image','tbl_product_image.idProduct','=','tbl_product.idProduct')
        ->join('tbl_country', 'tbl_country.idCountry', '=', 'tbl_product.idCountry')
        ->leftJoin('tbl_product_rate', 'tbl_product_rate.idProduct', '=', 'tbl_product.idProduct')
        ->select(
            'tbl_product.idProduct',
            'nameProduct',
            'tbl_product_image.firstImage',
            'priceProduct',
            'nameCountry',
            DB::raw('COALESCE(SUM(rate), 0) AS tong'),
            DB::raw('COALESCE(COUNT(*), 0) AS so_luong')
        )
        ->groupBy('tbl_product.idProduct',
        'nameProduct',
        'tbl_product_image.firstImage','priceProduct','nameCountry')
        ->paginate(24);
        
        $saleoff = DB::table('tbl_sale_off')->where('startTime','<=', date('Y-m-d'), 'and', 'endTime','>=',date('Y-m-d'))->get();
        $category = DB::table('tbl_category')->limit(12)->get();
        $flag_session =false;
        if(session()->has('hasLogged'))
        {
            $flag_session =true;
            $cart = DB::select('SELECT tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,GROUP_CONCAT(tbl_classify_product.nameSegment SEPARATOR " | ") 
            AS phan_loai, SUM(tbl_classify_product.priceSegment) 
            AS tong_phu_thu, tbl_product_image.firstImage, tbl_cart.quantity 
            FROM tbl_product,tbl_cart,tbl_classify_product,tbl_product_image 
            WHERE tbl_cart.idAccount='.Session::get('hasLogged').'
            AND tbl_cart.idSegment = tbl_classify_product.idSegment 
            AND tbl_classify_product.idProduct = tbl_product.idProduct 
            AND tbl_product_image.idProduct = tbl_product.idProduct 
            GROUP BY tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,tbl_product_image.firstImage, tbl_cart.quantity');
            return view('client.showallproduct')->with('category',$category)->with('product_all',$product_all)->with('saleoff',$saleoff)->with('flag_session',$flag_session)->with('cart',$cart);
        }
        return view('client.showallproduct')->with('category',$category)->with('product_all',$product_all)->with('saleoff',$saleoff)->with('flag_session',$flag_session);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function add_to_cart(Request $request)
    {
        $category = DB::table('tbl_category')->limit(12)->get();
        $product = DB::table('tbl_product')
        ->join('tbl_country', 'tbl_country.idCountry', '=', 'tbl_product.idCountry')
        ->join('tbl_product_image', 'tbl_product.idProduct', '=', 'tbl_product_image.idProduct')
        ->join('tbl_shop_of_seller', 'tbl_shop_of_seller.idShop', '=', 'tbl_product.idShop')
        ->where('tbl_product.idProduct', '=', $request->idProduct)
        ->get();

        $classify = DB::table('tbl_classify_product')
        ->select('codeClassify')
        ->groupBy('codeClassify')
        ->where('idProduct', '=', $request->idProduct)
        ->get();

        $segment = DB::table('tbl_classify_product')
        ->where('tbl_classify_product.idProduct', '=', $request->idProduct)
        ->get();

        $rate = DB::table('tbl_product_rate')
        ->join('tbl_account', 'tbl_account.idAccount', '=', 'tbl_product_rate.idAccount')
        ->where('tbl_product_rate.idProduct', '=', $request->idProduct)
        ->get();

        $saleoff = DB::table('tbl_sale_off')
        ->where('tbl_sale_off.idProduct', '=', $request->idProduct)
        ->where('startTime','<=', date('Y-m-d'), 'and', 'endTime','>=',date('Y-m-d'))->get();

        $follow = DB::table('tbl_shop_of_seller')
        ->leftJoin('tbl_shop_follow', 'tbl_shop_follow.idShop', '=', 'tbl_shop_of_seller.idShop')
        ->select(
            'tbl_shop_of_seller.idShop',
            DB::raw('COALESCE(COUNT(*), -1) AS follow')
        )
        ->groupBy('tbl_shop_of_seller.idShop')->get();

        $flag_session =false;
        if(session()->has('hasLogged'))
        {
            
            // 
            $ISsegment = DB::table('tbl_classify_product')
            ->select('codeClassify')
            ->where('tbl_classify_product.idProduct', '=', $request->idProduct)
            ->groupBy('codeClassify')
            ->get();

            $flag=true;
            foreach($ISsegment as $value)
            {
                $nameIP=$value->codeClassify;
                $idSegment = $request->$nameIP; 
                if(empty($idSegment))
                    $flag = false;
            }

            if($flag)
            {
                $checkExistInCart = DB::table('tbl_cart')
                ->join('tbl_classify_product', 'tbl_classify_product.idSegment', '=' , 'tbl_cart.idSegment')
                ->where('tbl_classify_product.idProduct', '=', $request->idProduct)
                ->get();
                
                if(count($checkExistInCart)>0)
                {
                    foreach($checkExistInCart as $value)
                    {
                        DB::delete("DELETE FROM tbl_cart WHERE idSegment = $value->idSegment");
                    }
                }
                foreach($ISsegment as $value)
                {
                    $idAccount = session()->get('hasLogged');
                    $nameIP=$value->codeClassify;
                    $idSegment = $request->$nameIP; 
                    $quantity = $request->quantity;
                    DB::insert("INSERT INTO tbl_cart VALUES($idAccount,$idSegment,$quantity)");
                }
            }
            
            $flag_session =true;
            $cart = DB::select('SELECT tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,GROUP_CONCAT(tbl_classify_product.nameSegment SEPARATOR " | ") 
            AS phan_loai, SUM(tbl_classify_product.priceSegment) 
            AS tong_phu_thu, tbl_product_image.firstImage, tbl_cart.quantity 
            FROM tbl_product,tbl_cart,tbl_classify_product,tbl_product_image 
            WHERE tbl_cart.idAccount='.Session::get('hasLogged').'
            AND tbl_cart.idSegment = tbl_classify_product.idSegment 
            AND tbl_classify_product.idProduct = tbl_product.idProduct 
            AND tbl_product_image.idProduct = tbl_product.idProduct 
            GROUP BY tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,tbl_product_image.firstImage, tbl_cart.quantity');
            return view('client.detailproduct')->with('category',$category)->with('product',$product)->with('classify',$classify)->with('segment',$segment)->with('rate',$rate)->with('follow',$follow)->with('saleoff',$saleoff)->with('flag_session',$flag_session)->with('cart',$cart);
        }
        return view('client.detailproduct')->with('category',$category)->with('product',$product)->with('classify',$classify)->with('segment',$segment)->with('rate',$rate)->with('follow',$follow)->with('saleoff',$saleoff)->with('flag_session',$flag_session);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function delete_cart(string $id)
    {
        DB::delete("DELETE tbl_cart FROM tbl_cart, tbl_classify_product WHERE tbl_cart.idSegment = tbl_classify_product.idSegment AND tbl_classify_product.idProduct = $id");
        return redirect('/');
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
