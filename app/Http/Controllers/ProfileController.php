<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Session;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idAccount)
    {
        //
        $category = DB::table('tbl_category')->limit(12)->get();
        $cart = DB::select('SELECT tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,GROUP_CONCAT(tbl_classify_product.nameSegment SEPARATOR " | ") 
            AS phan_loai, SUM(tbl_classify_product.priceSegment) 
            AS tong_phu_thu, tbl_product_image.firstImage, tbl_cart.quantity 
            FROM tbl_product,tbl_cart,tbl_classify_product,tbl_product_image 
            WHERE tbl_cart.idAccount='.Session::get('hasLogged').'
            AND tbl_cart.idSegment = tbl_classify_product.idSegment 
            AND tbl_classify_product.idProduct = tbl_product.idProduct 
            AND tbl_product_image.idProduct = tbl_product.idProduct 
            GROUP BY tbl_product.idProduct,tbl_product.nameProduct,tbl_product.priceProduct,tbl_product_image.firstImage, tbl_cart.quantity');

        $account = DB::table('tbl_account')
        ->join('tbl_permission','tbl_permission.codePermission','=','tbl_account.codePermission')
        ->where('idAccount','=',$idAccount)->get();

        $delivery_address = DB::table('tbl_delivery_address')
        ->join('tbl_ward','tbl_ward.idWard','=','tbl_delivery_address.idWard')
        ->join('tbl_district','tbl_district.idDistrict','=','tbl_ward.idDistrict')
        ->join('tbl_provine','tbl_provine.idProvine','=','tbl_district.idProvine')
        ->where('idAccount','=',$idAccount)->get();

        return view('client.profile')->with('category',$category)->with('flag_session',true)->with('cart',$cart)->with('account',$account)->with('delivery_address',$delivery_address);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
