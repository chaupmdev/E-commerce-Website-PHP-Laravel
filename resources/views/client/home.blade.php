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
            <div class="slider">
                <div class="slider-wrapper">
                    <div class="slider-slide">
                        <img src="{{ asset('laravel/shopbee/public/system/banners1.jpg') }}" alt="Slide 1">
                    </div>
                    <div class="slider-slide">
                        <img src="{{ asset('laravel/shopbee/public/system/bannerss6.jpg') }}" alt="Slide 2">
                    </div>
                    <div class="slider-slide">
                        <img src="{{ asset('laravel/shopbee/public/system/banners5.jpg') }}" alt="Slide 3">
                    </div>
                    <div class="slider-slide">
                        <img src="{{ asset('laravel/shopbee/public/system/banners4.jpg') }}" alt="Slide 4">
                    </div>
                    <div class="slider-slide">
                        <img src="{{ asset('laravel/shopbee/public/system/banners3.jpg') }}" alt="Slide 5">
                    </div>
                    <div class="slider-slide">
                        <img src="{{ asset('laravel/shopbee/public/system/banners2.jpg') }}" alt="Slide 6">
                    </div>
                    <div class="slider-slide">
                        <img src="{{ asset('laravel/shopbee/public/system/banner7.jpg') }}" alt="Slide 7">
                    </div>
                </div>
    
                <div class="slider-prev">&#10094;</div>
                <div class="slider-next">&#10095;</div>
            </div>
            <style>
                .slider {
                    position: relative;
                    overflow: hidden;
                }
    
                .slider-wrapper {
                    display: flex;
                    transition: transform 0.5s ease;
                }
    
                .slider-slide {
                    box-sizing: border-box;
                    width: 100%;
                    padding: 0 auto;
                    flex: 0 0 100%;
                }
    
                .slider-slide img {
                    display: block;
                    margin: 0 auto;
                    width: 100%;
                    height: auto;
                }
    
                .slider-prev,
                .slider-next {
                    position: relative;
                    top: 50%;
    
                    z-index: 1;
                    cursor: pointer;
                }
    
                .slider-prev {
                    left: 0;
                }
    
                .slider-next {
                    right: 0;
                }
            </style>
            <script>
                var sliderWrapper = document.querySelector('.slider-wrapper');
                var sliderPrev = document.querySelector('.slider-prev');
                var sliderNext = document.querySelector('.slider-next');
                var slideWidth = document.querySelector('.slider-slide').clientWidth;
                var currentSlide = 0;
    
                function slideNext() {
                    currentSlide++;
                    if (currentSlide > sliderWrapper.children.length - 1) {
                        currentSlide = 0;
                    }
                    sliderWrapper.style.transform = 'translateX(-' + slideWidth * currentSlide + 'px)';
                }
    
                var slideInterval = setInterval(slideNext, 5000);
    
                sliderPrev.addEventListener('click', function() {
                    currentSlide--;
                    if (currentSlide < 0) {
                        currentSlide = sliderWrapper.children.length - 1;
                    }
                    sliderWrapper.style.transform = 'translateX(-' + slideWidth * currentSlide + 'px)';
                });
    
                sliderNext.addEventListener('click', slideNext);
            </script>
            <div class="poster-slider" style="background-image: url({{ asset('laravel/shopbee/public/system/mua-he-oi-buc.png') }})"></div>
            <div class="box-flash-sale">
                <div class="title-flash-sale">
                    <h5>Siêu Sale Sập Sàn</h5>
                    <div class="countdown-box">
                        <p id="demo"></p>
                        <script>
                            // Set the date we're counting down to
                            var countDownDate = new Date("July 30, 2023 23:59:59").getTime();
                            
                            // Update the count down every 1 second
                            var x = setInterval(function() {
                            
                            // Get today's date and time
                            var now = new Date().getTime();
                            
                            // Find the distance between now and the count down date
                            var distance = countDownDate - now;
                            
                            // Time calculations for days, hours, minutes and seconds
                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                            // Display the result in the element with id="demo"
                            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                            + minutes + "m " + seconds + "s ";
                            
                            // If the count down is finished, write some text
                            if (distance < 0) {
                                clearInterval(x);
                                document.getElementById("demo").innerHTML = "EXPIRED";
                            }
                            }, 1000);
                            </script>
                    </div>
                </div>
                <div class="container-product">
                    @foreach($sale_off as $value)
                    <a href="{{ URL::to('chi-tiet-san-pham',$value->idProduct) }}"><div class="item-flash-sale">
                        <div class="img-item-flash-sale" style="background-image: url({{ asset('laravel/shopbee/public/product/'.$value->firstImage) }})">
                            <div class="percent-sale-off">{{ intval(100 - ($value->salePrice*100/$value->oldPrice)) }}%</div>
                            <div class="check-real">
                                <i class="fa fa-check"> Kiểm tra</i>
                            </div>
                        </div>
                        <span>SHOPBEE</span>
                        <div class="name-item-flash-sale">
                            <h6>
                                @if( mb_strlen($value->nameProduct) > 40)
                                    {{ substr($value->nameProduct, 0,40).'...' }}
                                @else
                                    {{ $value->nameProduct }}
                                @endif
                            </h6>
                        </div>
                        <div class="old-price-item-flash-sale">
                            <h6>{{ number_format($value->oldPrice) }}<span style="text-decoration: underline">đ</span></h6>
                        </div>
                        <div class="price-item-flash-sale">
                            {{ number_format($value->salePrice) }}<span style="text-decoration: underline; color:red">đ</span>
                        </div>
                        <div class="quantity-sale-off" style="background: linear-gradient(
                            to right, 
                            rgb(251, 15, 15) 0%, 
                            rgb(251, 15, 15) {{ intval($value->quantityLimit*100/$value->quantityStorage) }}%, 
                            rgb(255, 181, 181) {{ 100-intval($value->quantityLimit*100/$value->quantityStorage) }}%, 
                            rgb(255, 181, 181) 100%
                        );">
                            <i class="fa fa-fire">&emsp;Còn lại {{ $value->quantityLimit }}
                            </i>
                        </div>
                    </div></a>
                    @endforeach
                </div>
                <div class="box-button-see-more">
                    <a href="#"><button>XEM THÊM</button></a>
                </div>    
            </div>
            <div class="box-container" style="height: 150px;background-image: url({{ asset('laravel/shopbee/public/system/poster1.png') }})"></div>
            <div class="box-container box-thuong-hieu-chinh-hang">
                <div class="title-flash-sale">
                    <h5>Thương Hiệu Chính Hãng</h5>
                    <div class="box-container box-local-brand">
                        <div class="item-local-brand">
                            <div class="img-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-apple-pic.png') }});">
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand">
                                <div class="logo-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-applee.png') }});">

                                </div>
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand" style="height: 40px; background-color: white">
                                APPLE
                            </div>
                        </div>
                        <div class="item-local-brand">
                            <div class="img-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-adidas-pic.png') }});">
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand">
                                <div class="logo-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-adidas.png') }});">

                                </div>
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand" style="height: 40px; background-color: white">
                                ADIDAS
                            </div>
                        </div>
                        <div class="item-local-brand">
                            <div class="img-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-honda-pic.png') }});">
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand">
                                <div class="logo-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-honda.png') }});">

                                </div>
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand" style="height: 40px; background-color: white">
                                HONDA
                            </div>
                        </div>
                        <div class="item-local-brand">
                            <div class="img-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-oppo-pic.png') }});">
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand">
                                <div class="logo-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-oppo.png') }});">

                                </div>
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand" style="height: 40px; background-color: white">
                                OPPO
                            </div>
                        </div>
                        <div class="item-local-brand">
                            <div class="img-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-lv-pic.png') }});">
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand">
                                <div class="logo-item-local-brand" style="background-image: url({{ asset('laravel/shopbee/public/system/brand-lv.png') }});">

                                </div>
                            </div>
                            <div class="img-item-local-brand div-title-item-local-brand" style="height: 40px; background-color: white">
                                LOUIS VUITTON
                            </div>
                        </div>
                    </div>
                    <div class="box-container" style="height: 170px;background-image: url({{ asset('laravel/shopbee/public/system/poster2.png') }}); margin-bottom:0px"></div>
                </div>
                
            </div>

            <div class="box-container box-thuong-hieu-chinh-hang">
                <div class="poster-tien-ich" style="background-image: url({{ asset('laravel/shopbee/public/system/poster-tien-ich.png') }});"></div>
                <div class="box-tien-ich">
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item" style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-1.png') }});"></div>
                        </div>
                        <div class="name-item-tien-ich">
                            Hóa đơn điện
                        </div>
                    </div>
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item"  style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-2.png') }});"></div>
                        </div>
                        <div class="name-item-tien-ich">
                            Mua thẻ cào
                        </div>
                    </div>
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item"  style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-3.png') }});"></div>
                        </div>
                        <div class="name-item-tien-ich">
                            Mua thẻ game
                        </div>
                    </div>
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item"  style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-4.png') }});"></div>
                        </div>
                        <div class="name-item-tien-ich">
                            Vé số Vietlott
                        </div>
                    </div>
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item"  style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-5.png') }});"></div>
                        </div>
                        <div class="name-item-tien-ich">
                            Vé máy bay
                        </div>
                    </div>
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item"  style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-6.png') }});"></div>
                        </div>
                        <div class="name-item-tien-ich">
                            Đối tác Shopbee
                        </div>
                    </div>
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item"  style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-7.png') }});"></div>
                        </div>
                        <div class="name-item-tien-ich">
                            Nạp điện thoại
                        </div>
                    </div>
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item"  style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-8.png') }});"> </div>
                        </div>
                        <div class="name-item-tien-ich">
                            Hóa đơn nước
                        </div>
                    </div>
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item"  style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-9.png') }});"></div>
                        </div>
                        <div class="name-item-tien-ich">
                            Hóa đơn Internet
                        </div>
                    </div>
                    <div class="item-tien-ich">
                        <div class="img-item-tien-ich">
                            <div class="img-item"  style="background-image: url({{ asset('laravel/shopbee/public/system/tien-ich-10.png') }});"> </div>
                        </div>
                        <div class="name-item-tien-ich">
                            Vé tàu lửa
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
   </section>
@endsection
@section('cart-box')
   @include('client.cart')
@endsection