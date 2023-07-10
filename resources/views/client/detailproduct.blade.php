@extends('masterlayout')
@section('content')
<section class="new_arrivals_area section-padding-30 clearfix">

    <?php $count=0; foreach($rate as $star){$count+= $star->rate;}?>
    @foreach($product as $value)
    <div class="box-container" style="background-color:rgb(236, 241, 241);">
        <div class="box-container-detail-product">
            <div class="title-flash-sale" style="height: 20px;">
                <p><a href="{{ URL::to('/') }}">Trang chủ</a > > <a href="{{ URL::to('/tat-ca-san-pham?page=1') }}">Sản phẩm</a > > <a>@if( mb_strlen($value->nameProduct)>50) {{ substr($value->nameProduct, 0,50).'...' }} @else {{$value->nameProduct}} @endif </a></p>
            </div>
            <div class="box-container">
                <div class="box-detail-product-left">
                    <div id="main-image-product" class="main-img-product" style="background: url({{asset('laravel/shopbee/public/product/'.$value->firstImage)}}); background-size:cover;"></div>
                    <div class="box-detail-img-product">
                        <div id="sub-image-product1" class="item-detail-img-product" style="background: url({{asset('laravel/shopbee/public/product/'.$value->firstImage)}}); background-size:cover;"></div>
                        <div id="sub-image-product2" class="item-detail-img-product" style="background: url({{asset('laravel/shopbee/public/product/'.$value->secondImage)}}); background-size:cover;"></div>
                        <div id="sub-image-product3" class="item-detail-img-product" style="background: url({{asset('laravel/shopbee/public/product/'.$value->thirdImage)}}); background-size:cover;"></div>
                        <div id="sub-image-product4" class="item-detail-img-product" style="background: url({{asset('laravel/shopbee/public/product/'.$value->fourthImage)}}); background-size:cover;"></div>
                        <div id="sub-image-product5" class="item-detail-img-product" style="background: url({{asset('laravel/shopbee/public/product/'.$value->fivethImage)}}); background-size:cover;"></div>
                    </div>
                    <script>
                        var clickDiv1 = document.getElementById("sub-image-product1");
                        var clickDiv2 = document.getElementById("sub-image-product2");
                        var clickDiv3 = document.getElementById("sub-image-product3");
                        var clickDiv4 = document.getElementById("sub-image-product4");
                        var clickDiv5 = document.getElementById("sub-image-product5");
                        var targetDiv = document.getElementById("main-image-product");



                        clickDiv1.addEventListener('mouseover', function onClick(event) {
                        targetDiv.style.background = "url({{asset('laravel/shopbee/public/product/'.$value->firstImage)}})";
                        targetDiv.style.backgroundSize = "cover";
                        });

                        clickDiv2.addEventListener('mouseover', function onClick(event) {
                        targetDiv.style.background = "url({{asset('laravel/shopbee/public/product/'.$value->secondImage)}})";
                        targetDiv.style.backgroundSize = "cover";
                        });

                        clickDiv3.addEventListener('mouseover', function onClick(event) {
                        targetDiv.style.background = "url({{asset('laravel/shopbee/public/product/'.$value->thirdImage)}})";
                        targetDiv.style.backgroundSize = "cover";
                        });

                        clickDiv4.addEventListener('mouseover', function onClick(event) {
                        targetDiv.style.background = "url({{asset('laravel/shopbee/public/product/'.$value->fourthImage)}})";
                        targetDiv.style.backgroundSize = "cover";
                        });

                        clickDiv5.addEventListener('mouseover', function onClick(event) {
                        targetDiv.style.background = "url({{asset('laravel/shopbee/public/product/'.$value->fivethImage)}})";
                        targetDiv.style.backgroundSize = "cover";
                        });

                    </script>

                    <div class="box-share-to-social">
                        <span>Chia sẽ:&ensp;</span>
                        <img src={{ asset('laravel/shopbee/public/system/logoFB.svg') }}>
                        <img src={{ asset('laravel/shopbee/public/system/logoMessenger.svg') }}>
                        <img src={{ asset('laravel/shopbee/public/system/logoP.svg') }}>
                        <img src={{ asset('laravel/shopbee/public/system/logoSwitter.svg') }}>
                        <img src={{ asset('laravel/shopbee/public/system/logoLink.svg') }}>
                    </div>
                </div>
                <div class="box-detail-product-right">
                    <div class="header-detail-product">
                        <h6>Xuất xứ: <span>{{ $value->nameCountry }}</span></h6>
                        <h5>{{ $value->nameProduct }}</h5>
                        <div class="old-price-item-flash-sale so-sao-danh-gia">
                            @if(count($rate)!=0)
                                @for($i=0; $i<intval($count/count($rate));$i++)
                                    <i class="fa fa-star" ></i>
                                @endfor
                                @if($count/count($rate)>intval($count/count($rate)))
                                    <i class="fa fa-star-half" ></i>
                                @endif
                            @endif
                            <span style="color:rgb(76, 76, 76)">(@if(count($rate)!=0)
                                {{number_format($count/count($rate), 1, '.', ',')}} 
                               @else
                                 0
                               @endif
                               <i class="fa fa-star" style="color: orange"></i>&nbsp;|&nbsp;
                               @if(count($rate)!=0)
                                {{ count($rate) }} 
                                @else
                                0
                                 @endif  đánh giá)<span>
                        </div>
                    </div>
                    <div class="footer-detail-product-left">
                        @if(count($saleoff)>0)
                            @foreach($saleoff as $sale)
                            <h5><i class="fa fa-fire" style="color: rgb(252, 81, 81); font-weight: bold"> {{intval(100 - ($sale->salePrice*100/$sale->oldPrice))}}%</i>&emsp;<span style="text-decoration: line-through; font-weight: normal; color: rgb(104, 104, 104)">{{ number_format($sale->oldPrice) }}đ</span></h5>
                            <h3>{{ number_format($sale->salePrice) }} <span style="text-decoration: underline">đ</span></h3>
                            @endforeach
                        @else
                            <h3>{{ number_format($value->priceProduct) }} <span style="text-decoration: underline">đ</span></h3>
                        @endif
                       {{-- Item --}}

                       @foreach($classify as $class)
                            <h6 style="text-transform: capitalize;">{{  $class->codeClassify }}:</h6>
                            <form action="" method="post">
                                {{ csrf_field() }}
                            <div class="box-cac-size">

                                @foreach($segment as $seg)
                                    {{-- Value --}}
                                    @if($seg->codeClassify == $class->codeClassify)
                                        <div id="item-size" class="item-size">
                                            <input type="radio" name="{{$seg->codeClassify}}" value="{{$seg->idSegment}}" style="width: 20px; transform: scale(1.2)">
                                            {{$seg->nameSegment}}
                                            <h6>+{{ number_format($seg->priceSegment)}}<span>đ</span></h6>
                                        </div>
                                    @endif
                                    <input type="hidden" name="idProduct" value="{{$seg->idProduct}}">
                                    {{-- Value --}}
                                @endforeach
                                
                            </div>
                        @endforeach

                        {{-- Item --}}
                        <h5></h5>

                        <h6>Số lượng:</h6>
                        <input type="number" name="quantity" min="1" value="1">

                        <div class="group-button">
                            <button>Mua Ngay</button>
                            <button name="add-to-cart" class="add-to-cart">Thêm vào giỏ</button>
                        </div>
                    </form>
                    </div>
                    <div class="footer-detail-product-right">
                        <div class="header">
                            <div class="logo-shop-seller"  style="background: url({{asset('laravel/shopbee/public/shop_of_seller/'.$value->imageShop)}}); background-size:cover;"></div>
                            <div class="name-shop-seller">
                                <h6>{{ $value->nameShop}}</h6>
                                <div class="item-official"><i class="fa fa-check"></i> OFFICIAL</div>
                            </div>
                        </div>

                        <div class="header info-shop-seller">
                            <div class="box-ti-le-phan-hoi">
                                <h5>100%</h5>
                                <h6>Tỉ lệ phản hồi chat</h6>
                            </div>
                            <div class="box-so-nguoi-theo-doi">
                                @foreach($follow as $f)
                                    @if($f->idShop == $value->idShop)
                                        <h5>{{$f->follow}}</h5>
                                    @endif
                                @endforeach                               
                                <h6>Người theo dõi</h6>
                            </div>
                        </div>

                        <div class="box-chuong-trinh-shop-seller" style="background: url({{ asset('laravel/shopbee/public/system/box-seller.png') }});background-size: cover;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="box-container-detail-product">                
            <div class="box-container">
                <div class="box-thong-tin-mo-ta">
                    <h6>Thông Tin Mô Tả</h6>
                    <p>{{ $value->description }}</p>
                </div>
                <div class="box-danh-gia-san-pham">
                    
                    <h6>Đánh Giá &emsp;<span style="font-weight: normal; font-size:20px">(
                        @if(count($rate)!=0)
                         {{number_format($count/count($rate), 1, '.', ',')}} 
                        @else
                          0
                        @endif
                        <i class="fa fa-star" style="color: orange"></i> | 
                        @if(count($rate)!=0)
                         {{ count($rate) }} 
                         @else
                         0
                          @endif 
                          đánh giá)</span></h6>
                    @if(count($rate)!=0)
                        @foreach($rate as $r)
                        <div class="item-rate">
                            <p style="font-weight: 600">{{ $r->fullName }}</p>
                            <p>{{ date("d/m/Y", strtotime($r->timeRate)) }}</p>
                            @for($i=0; $i<$r->rate;$i++)
                                <i class="fa fa-star" ></i>
                            @endfor
                            <p>{{ $r->feedBack }}</p>
                            @if($r->firstImage != null || $r->secondImage != null ||$r->thirdImage != null)
                            <div class="group-img-feed-back">
                                @if($r->firstImage != null)                            
                                    <div class="img-feed-back" style="background: url({{asset('laravel/shopbee/public/product_rate/'.$r->firstImage)}}); background-size:cover"></div>
                                @endif
                                @if($r->secondImage != null)                            
                                    <div class="img-feed-back" style="background: url({{asset('laravel/shopbee/public/product_rate/'.$r->secondImage)}}); background-size:cover"></div>
                                @endif
                                @if($r->thirdImage != null)                            
                                    <div class="img-feed-back" style="background: url({{asset('laravel/shopbee/public/product_rate/'.$r->thirdImage)}}); background-size:cover"></div>
                                @endif
                            </div>     
                            @endif                  
                        </div>
                        @endforeach
                    @else
                        <p style="font-size: 17px">Chưa có bình luận nào!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection
@section('cart-box')
   @include('client.cart')
@endsection