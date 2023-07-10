<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Shopbee - Trang chủ</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('laravel/shopbee/public/system/logoShopbee.png') }}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('laravel/shopbee/public/FE/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('laravel/shopbee/public/FE/style.css') }}">
    <link rel="stylesheet" href="{{ asset('laravel/shopbee/public/FE/css/fe.css') }}">
    <script src="{{ asset('laravel/shopbee/public/BE/ckeditor/ckeditor.js') }}"></script>
      <script>
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor1');
      </script>

</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                  <a class="nav-brand" href="{{ URL::to('/') }}"><img style="height: 35x; width: 85px;" src="{{ asset('laravel/shopbee/public/system/logoShopbee.png') }}" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li>
                                    <a href="#">Danh mục</a>
                                <div class="megamenu">   
                                    @foreach($category as $key => $cate)
                                    <ul class="single-mega cn-col-4">
                                        <a href="{{ URL::to('danh-muc-san-pham',$cate->idCategory) }}" style="font-size:16px; font-weight:bold" class="title">{{ $cate->nameCategory }}</a>    
                                        {{-- @foreach($brand as $key => $br)
                                            @if($br->category_id == $cate->category_id )
                                                <a style="font-size:13px" href="{{ URL::to('show-brand',$br->brand_id) }}">{{ $br -> brand_name }}</a>
                                            @endif
                                        @endforeach                   --}}
                                    </ul> 
                                     @endforeach                                                                      
                                </div>
                            </li>
                            <li> <a href="{{ URL::to('tat-ca-san-pham?page=1') }}">Sản phẩm</a></li>
                            <li> <a href="#">Sale off</a></li>
                            <li> <a href="#">Liên hệ</a></li>
                            <li> <a href="#">Đối tác</a></li>
                        </ul>
                    </div>
                </div>
                    <!-- Nav End -->
            </nav>
            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->

                <div class="search-area">
                    {{-- <form action="{{ URL::to('search') }}" method="post">
                        {{ csrf_field() }}
                        <input type="search" name="keyword" id="headerSearch" placeholder="Type for search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form> --}}
                </div>
                <!-- Favourite Area -->
                {{-- @if(session('id') != NULL )
                    <div class="favourite-area">
                        <a href="{{ URL::to('order-history') }}"><img src="{{ asset('laravel/shopbee/public/FE/img/core-img/heart.svg') }}" alt=""></a>
                    </div>  
                @endif 

                @if(session('id') != NULL )
                <div class="user-login-info">
                    <a href="{{ URL::to('customer', Auth::id()) }}"><img src="{{ asset('laravel/shopbee/public/FE/img/core-img/user.svg') }}" alt=""></a>
                </div>
                <div class="user-login-info">
                    <a href="{{ URL::to('logout') }}"><img src="{{ asset('laravel/shopbee/public/FE/img/core-img/sign_out.svg') }}" alt=""></a>
                </div>
                @else
                <div class="user-login-info">
                    <a href="{{ URL::to('flogin') }}"><img src="{{ asset('laravel/shopbee/public/FE/img/core-img/user.svg') }}" alt=""></a>
                </div>
                @endif --}}
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="{{ asset('laravel/shopbee/public/FE/img/core-img/bag.svg') }}" alt=""> <span></span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="{{ asset('laravel/shopbee/public/FE/img/core-img/bag.svg') }}" alt=""> <span></span></a>
        </div>

        <div class="cart-content d-flex">
            {{-- Login/Logout --}}
            @yield('cart-box')
            {{-- Login/Logout --}}
            {{-- ------------- --}}
            {{-- Cart --}}
            {{-- Cart --}}
        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Welcome Area Start ##### -->
    {{-- @yield('slider') --}}
    <!-- ##### Welcome Area End ##### -->
    
    @yield('content')
  

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                        </div>
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="shop.html">Mua sắm</a></li>
                                <li><a href="blog.html">Bài viết</a></li>
                                <li><a href="contact.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li><a href="#">Đơn hàng</a></li>
                            <li><a href="#">Thanh toán</a></li>
                            <li><a href="#">Giao hàng</a></li>
                            <li><a href="#">Hướng dẫn</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Điều khoản và điều kiện</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_heading mb-30">
                            <h6>Gửi email:</h6>
                        </div>
                        <div class="subscribtion_form">
                            <form action="#" method="post">
                                <input type="email" name="mail" class="mail" placeholder="Viết gì đó...">
                                <button type="submit" class="submit"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

<div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Bản quyền &copy;<script>document.write(new Date().getFullYear());</script> Chịu trách nhiệm <i class="fa fa-heart-o" aria-hidden="true"></i> bởi <a href="#" target="_blank">Phạm Minh Châu</a>, liên hệ công việc <a href="#" target="_blank">chaupm.dev@gmail.com</a>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('laravel/shopbee/public/FE/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('laravel/shopbee/public/FE/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('laravel/shopbee/public/FE/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('laravel/shopbee/public/FE/js/plugins.js') }}"></script>
    <!-- Classy Nav js -->
    <script src="{{ asset('laravel/shopbee/public/FE/js/classy-nav.min.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('laravel/shopbee/public/FE/js/active.js') }}"></script>

    

    

</body>

</html>