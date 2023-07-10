<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idAccount)
    {
        $category = DB::table('tbl_category')->limit(12)->get();
        $cart = DB::select('SELECT tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,GROUP_CONCAT(tbl_classify_product.nameSegment SEPARATOR " | ") 
            AS phan_loai, SUM(tbl_classify_product.priceSegment) 
            AS tong_phu_thu, tbl_product_image.firstImage, tbl_cart.quantity 
            FROM tbl_product,tbl_cart,tbl_classify_product,tbl_product_image 
            WHERE tbl_cart.idAccount='.$idAccount.'
            AND tbl_cart.idSegment = tbl_classify_product.idSegment 
            AND tbl_classify_product.idProduct = tbl_product.idProduct 
            AND tbl_product_image.idProduct = tbl_product.idProduct 
            GROUP BY tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,tbl_product_image.firstImage, tbl_cart.quantity');

        $delivery_address = DB::table('tbl_delivery_address')
        ->join('tbl_ward','tbl_ward.idWard','=','tbl_delivery_address.idWard')
        ->join('tbl_district','tbl_district.idDistrict','=','tbl_ward.idDistrict')
        ->join('tbl_provine','tbl_provine.idProvine','=','tbl_district.idProvine')
        ->join('tbl_account','tbl_account.idAccount','=','tbl_delivery_address.idAccount')
        ->where('tbl_delivery_address.idAccount','=',$idAccount)->get();

        $pay = DB::table('tbl_pay')->get();
        $ship = DB::table('tbl_ship_code')->get();
        
            return view('client.checkout')->with('category',$category)->with('flag_session',true)->with('cart',$cart)
            ->with('delivery_address',$delivery_address)->with('pay',$pay)->with('ship',$ship)->with("flag",false);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function voucher(Request $request)
    {
        if(session()->has('hasLogged'))
        {
            $idAccount = session()->get('hasLogged');

            $category = DB::table('tbl_category')->limit(12)->get();
            $cart = DB::select('SELECT tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,GROUP_CONCAT(tbl_classify_product.nameSegment SEPARATOR " | ") 
                AS phan_loai, SUM(tbl_classify_product.priceSegment) 
                AS tong_phu_thu, tbl_product_image.firstImage, tbl_cart.quantity 
                FROM tbl_product,tbl_cart,tbl_classify_product,tbl_product_image 
                WHERE tbl_cart.idAccount='.$idAccount.'
                AND tbl_cart.idSegment = tbl_classify_product.idSegment 
                AND tbl_classify_product.idProduct = tbl_product.idProduct 
                AND tbl_product_image.idProduct = tbl_product.idProduct 
                GROUP BY tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,tbl_product_image.firstImage, tbl_cart.quantity');

            $delivery_address = DB::table('tbl_delivery_address')
            ->join('tbl_ward','tbl_ward.idWard','=','tbl_delivery_address.idWard')
            ->join('tbl_district','tbl_district.idDistrict','=','tbl_ward.idDistrict')
            ->join('tbl_provine','tbl_provine.idProvine','=','tbl_district.idProvine')
            ->join('tbl_account','tbl_account.idAccount','=','tbl_delivery_address.idAccount')
            ->where('tbl_delivery_address.idAccount','=',$idAccount)->get();

            $pay = DB::table('tbl_pay')->get();
            $ship = DB::table('tbl_ship_code')->get();

            $conditionPrice = $request->conditionPrice;
            $codeVoucher = $request->codeVoucher;
            $today = date('Y-m-d');

            $voucher = DB::select("SELECT tbl_product.idProduct,tbl_shop_voucher.percentOff,tbl_shop_voucher.maxPriceOff FROM tbl_cart, tbl_product, tbl_shop_voucher, tbl_shop_of_seller, tbl_classify_product 
            WHERE tbl_cart.idSegment = tbl_classify_product.idSegment AND tbl_classify_product.idProduct = tbl_product.idProduct
            AND tbl_product.idShop = tbl_shop_of_seller.idShop AND tbl_shop_voucher.idShop = tbl_shop_of_seller.idShop 
            AND tbl_shop_voucher.codeVoucher='".$codeVoucher."' AND tbl_cart.idAccount=".$idAccount." AND tbl_shop_voucher.conditionPrice<=".$conditionPrice."
            AND tbl_shop_voucher.startTime <= '".$today."' AND tbl_shop_voucher.endTime >= '".$today."' GROUP BY tbl_product.idProduct,tbl_shop_voucher.percentOff,tbl_shop_voucher.maxPriceOff");
        
            if(count($voucher)>0)
            {
                //mã giảm giá có tồn tại với sản phẩm trong giỏ
                return view('client.checkout')->with('category',$category)->with('flag_session',true)
                ->with('cart',$cart)->with('delivery_address',$delivery_address)->with('pay',$pay)->with('ship',$ship)->with("flag",true)->with('voucher', $voucher);
            }
            return view('client.checkout')->with('category',$category)->with('flag_session',true)
            ->with('cart',$cart)->with('delivery_address',$delivery_address)->with('pay',$pay)->with('ship',$ship)->with("flag",false);

        }
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
