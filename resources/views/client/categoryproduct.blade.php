@extends('masterlayout')
@section('content')
   <section class="new_arrivals_area section-padding-30 clearfix">
    <div class="main">
        <div class="nav-bar-home">
            <div class="nav-bar-child">                
                <h6>Nổi bật</h6>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/nb1.png') }}">
                    <span>Shopbee ChatGPT</span>
                </div>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/nb2.png') }}">
                    <span>Astra Rewward</span>
                </div>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/nb3.png') }}">
                    <span>Shopbee Extra</span>
                </div>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/nb4.png') }}">
                    <span>Giá rẻ mỗi ngày</span>
                </div>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/nb5.png') }}">
                    <span>Xã kho khủng</span>
                </div>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/nb6.png') }}">
                    <span>Mã giảm giá</span>
                </div>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/nb7.png') }}">
                    <span>Ưu đãi thẻ, ví</span>
                </div>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/nb8.png') }}">
                    <span>Bảo hiểm 360</span>
                </div>
            </div>
            <div class="nav-bar-child">
                <h6>Danh mục</h6>
                @foreach ($category as $key => $value)
                <a href="{{ URL::to('danh-muc-san-pham',$value->idCategory) }}"><div class="item-nav-bar-child">
                        <img src="{{asset('laravel/shopbee/public/category/'.$value->imageCategory) }}">
                        <span>{{ $value->nameCategory }}</span>
                    </div></a>
                @endforeach
            </div>
        </div>
        <div class="main-container">
            <div class="box-container box-thuong-hieu-chinh-hang">
                <h6>Hàng Hiệu Giá Tốt</h6>
                <div class="box-container box-gird-3">
                    <div class="item-hang-hieu-gia-tot">
                        <div class="element-hang-hieu-gia-tot element-span" style="background: url({{ asset('laravel/shopbee/public/system/hhgt-1.png') }}); background-size:cover;"></div>
                        <div class="element-hang-hieu-gia-tot"  style="background: url({{ asset('laravel/shopbee/public/system/hhgt-11.png') }}); background-size:cover;"></div>
                        <div class="element-hang-hieu-gia-tot"  style="background: url({{ asset('laravel/shopbee/public/system/hhgt-12.png') }}); background-size:cover;"></div>
                    </div>
                    <div class="item-hang-hieu-gia-tot">
                        <div class="element-hang-hieu-gia-tot element-span" style="background: url({{ asset('laravel/shopbee/public/system/hhgt-2.png') }}); background-size:cover;"></div>
                        <div class="element-hang-hieu-gia-tot" style="background: url({{ asset('laravel/shopbee/public/system/hhgt-21.png') }}); background-size:cover;"></div>
                        <div class="element-hang-hieu-gia-tot" style="background: url({{ asset('laravel/shopbee/public/system/hhgt-22.png') }}); background-size:cover;"></div>
                    </div>
                    <div class="item-hang-hieu-gia-tot">
                        <div class="element-hang-hieu-gia-tot element-span" style="background: url({{ asset('laravel/shopbee/public/system/hhgt-3.png') }}); background-size:cover;"></div>
                        <div class="element-hang-hieu-gia-tot" style="background: url({{ asset('laravel/shopbee/public/system/hhgt-31.png') }}); background-size:cover;"></div>
                        <div class="element-hang-hieu-gia-tot" style="background: url({{ asset('laravel/shopbee/public/system/hhgt-32.png') }}); background-size:cover;"></div>
                    </div>
                </div>
            </div>
            <div class="box-container box-thuong-hieu-chinh-hang">
                <h6>Tất Cả Sản Phẩm</h6>
                <div class="box-container box-gird-6">
                    @foreach($categoryProduct as $value)                    
                    <a href="{{ URL::to('chi-tiet-san-pham',$value->idProduct) }}"><div class="item-flash-sale item-product-all">
                        <div class="img-item-flash-sale" style="background-image: url({{ asset('laravel/shopbee/public/product/'.$value->firstImage) }})">
                            <div class="percent-sale-off" style="font-size: 11px; padding-top:3px"><i class="fa fa-fire"></i>Hot</div>
                            <div class="check-real">
                                <i class="fa fa-check">Kiểm tra</i>
                            </div>
                        </div>
                        <span style="font-weight: 500">SHOPBEE</span>
                        <div class="name-item-flash-sale">
                            <h6>
                                @if( mb_strlen($value->nameProduct) > 40)
                                    {{ substr($value->nameProduct, 0,40).'...' }}
                                @else
                                    {{ $value->nameProduct }}
                                @endif
                            </h6>
                        </div>
                        <div class="old-price-item-flash-sale so-sao-danh-gia">

                            @if($value->tong==0)
                                <span style="font-weight: normal">Chưa đánh giá</span>
                            @else
                                @for($i=0; $i<intval($value->tong/$value->so_luong);$i++)
                                    <i class="fa fa-star" ></i>
                                @endfor
                                @if($value->tong/$value->so_luong > intval($value->tong/$value->so_luong))
                                    <i class="fa fa-star-half" ></i>
                                @endif
                                <span style="font-weight: normal">{{ number_format($value->tong/$value->so_luong, 1, '.', ',') }}</span>
                            @endif
                        </div>
                        <div class="div-tai-tro">Tài trợ</div>
                        <div class="price-item-flash-sale price-roduct-all">
                            {{ number_format($value->priceProduct) }}<span style="text-decoration: underline; color:red">đ</span>
                        </div>
                        <div class="bottom-item-product-left">Đã bán 0</div>
                        <div class="bottom-item-product-right">{{ $value->nameCountry }}</div>
                    </div></a>
                    @endforeach
                </div>
                <div class="box-container pageinate-box">
                    {{-- @if($_GET['page'] == 1)
                        <a href="{{ URL::to('danh-muc-san-pham?page=1') }}">
                    @else
                        <a href="{{ URL::to('danh-muc-san-pham?page='.($_GET['page']-1)) }}">
                    @endif
                    <button class="btn-type-1"><i class="fa fa-chevron-left"></i>&ensp;Trước Đó</button></a>
                     
                    <a href="{{ URL::to('danh-muc-san-pham?page='.($_GET['page']+1)) }}"><button class="btn-type-1">Trang Sau&ensp;<i class="fa fa-chevron-right"></i></button> --}}
                </div>
            </div>
            <div class="box-container box-thuong-hieu-chinh-hang box-gird-3">
                <div class="item-mo-the-lan-dau" style="background: url({{ asset('laravel/shopbee/public/system/mo-the-1.png') }}); background-size:cover"></div>
                <div class="item-mo-the-lan-dau" style="background: url({{ asset('laravel/shopbee/public/system/mo-the-2.png') }}); background-size:cover"></div>
                <div class="item-mo-the-lan-dau" style="background: url({{ asset('laravel/shopbee/public/system/mo-the-3.png') }}); background-size:cover"></div>
            </div>
        </div>
    </div>
   </section>
@endsection
@section('cart-box')
   @include('client.cart')
@endsection

