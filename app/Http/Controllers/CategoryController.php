<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idCategory)
    {
        $categoryProduct = DB::table('tbl_product')
        ->join('tbl_country', 'tbl_country.idCountry', '=', 'tbl_product.idCountry')
        ->join('tbl_product_image', 'tbl_product.idProduct', '=', 'tbl_product_image.idProduct')
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
        ->where('idCategory','=',$idCategory)
        ->paginate(24);

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
            return view('client.categoryproduct')->with('categoryProduct', $categoryProduct)->with('category',$category)->with('flag_session',$flag_session)->with('cart',$cart);
        }
        return view('client.categoryproduct')->with('categoryProduct', $categoryProduct)->with('category',$category)->with('flag_session',$flag_session);
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
