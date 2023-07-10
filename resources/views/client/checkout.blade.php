@extends('masterlayout')
@section('content')
   <section class="new_arrivals_area section-padding-30 clearfix">
    <div class="main">
        <div class="nav-bar-checkout">
            <div class="nav-bar-child">  
                <h6>Thông Tin Đơn Hàng</h6>
                @php $count_price=0; $count_segment=0; $price_off=0; @endphp
                @foreach($cart as $value)
                    @php 
                        $count_price+= $value->quantity*$value->priceProduct;
                        $count_segment+= $value->quantity*$value->tong_phu_thu;
                    @endphp
                    @if($flag)
                        @foreach($voucher as $vc)
                            @if ($vc->idProduct == $value->idProduct)
                                @php
                                    $price_off += ($value->quantity*$value->priceProduct + $value->quantity*$value->tong_phu_thu)*($vc->percentOff/100)
                                @endphp
                            @endif                            
                        @endforeach
                        
                    @endif
                @endforeach
                @if(!empty($voucher))
                    @foreach($voucher as $vc)
                        @if($price_off>$vc->maxPriceOff)
                            @php $price_off=$vc->maxPriceOff; @endphp
                        @endif
                    @endforeach
                @endempty
                
                <table>
                    <th></th>
                    <th></th>
                    <tr>
                        <td style="text-align: left;">Tổng tiền sản phẩm:</td>
                        <td style="text-align: right; font-weight: 600">{{number_format($count_price)}}đ</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Tiền phân loại, phụ kiện:</td>
                        <td style="text-align: right; font-weight: 600">{{number_format($count_segment)}}đ</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Giảm giá voucher:</td>
                        <td style="text-align: right; font-weight: 600">{{number_format($price_off)}}đ</td>
                       
                        
                    </tr>
                    <tr>
                        <td style="text-align: left;">Phí giao hàng:</td>
                        <td style="text-align: right; font-weight: 600">{{number_format(30000)}}đ</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Tổng thành tiền:</td>
                        <td style="text-align: right; font-weight: 600; font-size:25px; color:red">{{number_format($count_price+$count_segment+30000-$price_off)}}đ</td>
                    </tr>
                </table>
                <button>Đặt Hàng</button>
            </div>
        </div>
        <div class="main-container-checkout">
            <div class="box-container box-container-checkout">
                <h6>Chi Tiết Đơn Hàng</h6>
                <div class="box-container box-delivery-address">
                    @foreach($delivery_address as $value)
                    <div class="item-delivery-address">
                        <div class="item-delivery-address-left">
                            @if($value->isDefault == 1)
                            <input type="radio" style="transform: scale(1.3)" name="choose-delivery-address" checked="true">
                            @else
                            <input type="radio" style="transform: scale(1.3)" name="choose-delivery-address">
                            @endif
                        </div>
                        <div class="item-delivery-address-right">
                            <h6>{{ $value->fullName }}</h6>
                            <p>
                                @if(mb_strlen($value->nameDistrict.', '.$value->nameProvine)>30)
                                {{ substr($value->nameDistrict.', '.$value->nameProvine,0,30).'...' }}
                                @else
                                {{ $value->nameDistrict.', '.$value->nameProvine }}
                                @endif
                            </p>
                            <p>
                                @if(mb_strlen($value->detailAddress)>30)
                                {{ substr($value->detailAddress,0,30).'...' }}
                                @else
                                {{ $value->detailAddress }}
                                @endif
                            </p>
                            <p>{{ $value->phoneNumber }}</p>
                        </div>
                    </div>             
                    @endforeach    
                </div>
                <a href="{{ URL::to('trang-ca-nhan', Session::get('hasLogged')) }}"><button>Thêm địa chỉ</button></a>
                <div class="box-all-product-cart">
                    <table>
                        <th>Sản phẩm</th>
                        <th></th>
                        <th>Phân loại</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
    
                        {{-- Item --}}
                        
                        @foreach($cart as $value)
                    <tr>
                        {{-- Pic --}}
                        <td>
                            <img style="width: 80px; height: 70px;" src="{{ asset('laravel/shopbee/public/product/'.$value->firstImage) }}">
                        </td>
                        {{-- Name --}}
                        <td>
                            @if(mb_strlen($value->nameProduct)> 20)
                                {{ substr($value->nameProduct, 0, 20)."..." }}
                            @else
                                {{ $value->nameProduct }}
                            @endif
                        </td>
                        {{-- Classify --}}
                        <td>{{ $value->phan_loai }} <h6 style="font-weight: normal; font-size:12px">+{{ number_format($value->tong_phu_thu) }}đ</h6></td>
                        {{-- Price --}}
                        <td>{{ number_format($value->priceProduct) }}đ</td>
                        {{-- Quantity --}}
                        <td>{{ $value->quantity }}</td>
                        {{-- Total --}}
                        <td style="font-weight: 600">{{ number_format($value->quantity*($value->priceProduct + $value->tong_phu_thu)) }}đ</td>
                        {{-- CRUD --}}
                        
                    </tr>                        
                    @endforeach
                        {{-- /Item --}}
                        
                    </table>
                </div><br>
                <h6>Giảm Giá Sản Phẩm</h6>
                <div class="box-container box-code">
                    <form action="{{URL::to('su-dung-voucher')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" class="input-code" placeholder="Nhập voucher của Shop (nếu có)..." name="codeVoucher">
                        <input type="hidden" name="conditionPrice" value="{{$count_price+$count_segment}}">
                        <button class="ap-voucher">Áp dụng</button>
                    </form>
                    @if($flag)
                        <p>Thành công (<b>{{count($voucher)}}</b> sản phẩm)</p>
                    @endif
                    
                    </div><br>
                    <h6>Chọn Dịch Vụ Giao Hàng:</h6>
                    <div class="box-container box-delivery-address">
                        @foreach($ship as $value)
                        <div class="item-ship-code">
                            <div class="item-ship-code-left">
                                <input type="radio" style="transform: scale(1.3)" name="choose-delivery-address" checked="true">
                            </div>
                            <div class="item-ship-code-center">
                                <img src="{{ asset('laravel/shopbee/public/shipcode/'.$value->imageShip) }}" alt="" style="background-size: cover; border-radius:50%">
                            </div>
                            <div class="item-ship-code-right">
                                <h6>{{$value->nameShip}}</h6>
                                <p>{{$value->days}} ngày</p>
                                <p>{{number_format($value->price)}}</p>
                            </div>
                        </div>
                        @endforeach
                </div>
                <br>
                <h6>Hình Thức Thanh Toán:</h6>
                <div class="box-container box-pay">
                    @foreach($pay as $value)
                    <div class="item-pay">
                        <div class="item-pay-left">
                            <input type="radio" style="transform: scale(1.3)" name="choose-pay"  checked="true">
                        </div>
                        <div class="item-pay-right">
                            <center>
                            <img src="{{ asset('laravel/shopbee/public/pay/'.$value->imagePay) }}" alt="" style="background-size: cover"></center>
                        </div>
                    </div>
                    @endforeach
            </div><br>
            <h6>Ghi Chú Giao Hàng:</h6>
            <div class="box-container box-code">
                <input type="text" class="input-code" placeholder="Ghi chú điều gì đó (nếu có)..." style="width: 100%">
            </div>
            <button style="float: right">Bước tiếp theo</button>
        </div>
    </div>
   </section>
@endsection
@section('cart-box')
   @include('client.cart')
@endsection
<style>
    .nav-bar-child table{width: 100%;}
    .nav-bar-child button{width: 100%; padding: 10px 0; border: none; border-radius: 4px; background-color: orange; color: white; font-weight: 500; font-size: 18px; margin-top:15px}
    .nav-bar-child button:hover{background-color: rgb(255, 199, 94); transition: ease .4s; cursor: pointer;} .nav-bar-child button:focus{outline: none}
    .main-container-checkout h6{font-family: Arial, Helvetica, sans-serif}
    .item-pay{width: 157px; height: 100px; border: 1px solid rgb(213, 212, 212); border-radius: 4px}
    .item-pay:hover{background-color: rgb(247, 246, 246); transition: ease .4s; cursor: pointer;}
    .item-pay .item-pay-right img{width: 80px; height: 80px; background-size: cover}
    .item-pay .item-pay-left{width: 20%; height: 100%; float: left; display: flex; justify-content: center; align-items: center}
    .item-pay .item-pay-right{width: 80%; height: 100%; float: left; padding: 10px}
    .item-ship-code:hover{background-color: rgb(247, 246, 246); transition: ease .4s; cursor: pointer;}  .item-delivery-address:hover{background-color: rgb(247, 246, 246); transition: ease .4s; cursor: pointer;}
    .item-ship-code{width: 270px; height: 100px; border: 1px solid rgb(213, 212, 212); border-radius: 4px}
    .item-ship-code .item-ship-code-left{width: 10%; height: 100%; float: left; display: flex; justify-content: center; align-items: center}
    .item-ship-code .item-ship-code-center{width: 20%; height: 100%; float: left; display: flex; justify-content: center; align-items: center}
    .item-ship-code .item-ship-code-left img{width: 100px; height: 100%; background-size: cover}
    .item-ship-code .item-ship-code-right{width: 70%; height: 100%; float: left; padding: 10px} .item-ship-code .item-ship-code-right p{line-height: 1}
    .nav-bar-checkout{width: 35%; float: right;  height: auto; margin-bottom: 30px;  margin-top: 30px;}
    .main-container-checkout{width: 63%;   height: auto;    float: left;    margin-bottom: 30px;    margin-top: 30px;}
    .box-container-checkout{padding: 15px} .box-delivery-address{display: grid; grid-template-columns: auto auto auto; gap: 10px}
    .box-pay{display: grid; grid-template-columns: auto auto auto auto auto; gap: 10px}
    .box-delivery-address .item-delivery-address{width: 270px; height: 110px; border: 1px dashed rgb(213, 212, 212);border-radius: 4px}
    .box-delivery-address .item-delivery-address p{line-height: 5px; color: rgb(55, 55, 55)} .box-delivery-address .item-delivery-address h6{font-family: Arial, Helvetica, sans-serif}
    .box-delivery-address .item-delivery-address-left{width: 10%; height: 100%; float: left; display: flex; justify-content: center; align-items: center}
    .box-delivery-address .item-delivery-address-right{width: 90%; height: 100%; float: left; padding: 10px}
    .box-container-checkout button{width: 150px; height: 35px;background-color: rgb(255, 166, 0); border-radius: 4px;font-size: 12px; color: white; font-weight: 300px; border: none}
    .box-container-checkout button:hover{background-color: rgb(253, 205, 115); transition: ease .4s; cursor: pointer;}
    .box-container-checkout button:focus{outline: none} .box-container-checkout .box-all-product-cart table{width: 100%; margin-top: 30px}
    .box-container-checkout .box-all-product-cart th{font-weight: 600} .box-container .input-code{float: left;width: 50%; padding: 6.5px 10px; border-radius: 4px; border: 1px solid rgb(200, 200, 200)} .box-container .input-code:focus{outline: none}
    .box-code{padding: 15px} .box-code .ap-voucher{background-color: #6b905c; float: left; margin: 0 10px} .box-code .ap-voucher:hover{background-color: #A3BB98; transition: ease .4s; cursor: pointer;}

</style>
