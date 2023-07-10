<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .box-all-product-cart a{color:black; font-size: 13px}
        #box-register{display: none;} #box-register p{line-height: 0} #box-login p{line-height: 0}
        .container-box-login{
            width: 100%; height: 100%; padding: 80px 100px; 
        }
        .container-cart{
            padding: 20px 10px; 
        }
        .container-box-login h3{font-family: Arial, Helvetica, sans-serif; color: rgb(40, 40, 40)} .container-box-login h5{font-family: Arial, Helvetica, sans-serif; color: rgb(79, 79, 79); font-weight: normal}
        .input-text{border: none; border-bottom: 1px solid gray ;width: 450px; height: 40px; padding: 5px 10px; margin-bottom: 10px}.container-box-login h6{font-family: Arial, Helvetica, sans-serif; color: rgb(79, 79, 79); font-weight: normal}
        .input-text:focus{outline: none} .container-box-login button{width: 450px; height: 50px;border: none; background-color: rgb(255, 166, 0); border-radius: 4px;font-size: 17px; color: white; font-weight: 300px; margin: 30px 0;}
        
        .box-all-product-cart{width: 100%; height: auto} td{padding: 5px; text-align: center} th{padding: 5px; text-align: center;font-weight: normal} i{ cursor: pointer;}
        .total-all{width: 100%; height: 80px; padding: 20px 0;} .total-all button{float: right;width: 200px; height: 35px;background-color: rgb(255, 166, 0); border-radius: 4px;font-size: 13px; color: white; font-weight: 300px;margin:0;}
        .total-all button:hover{ cursor: pointer; background-color: rgb(254, 193, 79)}.total-all h6{float: right;margin: 7px 20px; color:black} .total-all span{color: red; font-weight: 300px; font-size: 20px}
        .container-box-login .lien-ket{color: rgb(68, 93, 255)}.lien-ket:hover{cursor: pointer;}
    </style>
</head>
<body>
    @if(!$flag_session)
        <div class="container-box-login">
            <div id="box-login">
                <h3>Đăng nhập tài khoản</h3>
                <h5>Nhập tài khoản và mật khẩu Shopbee</h5><br>
                <form method="post" action="{{ URL::to('/dang-nhap') }}">
                    {{ csrf_field() }}
                    <input name="username" type="text" class="input-text" placeholder="Tên đăng nhập...">
                    @error('username')
                        <p style="color: red">{{$message}}</p>
                    @enderror
                    <input name="password" type="password" class="input-text" placeholder="Mật khẩu...">
                    @error('password')
                        <p style="color: red">{{$message}}</p>
                    @enderror
                    <button>Đăng Nhập</button>
                </form>
                <h6 class="lien-ket">Quên mật khẩu</h6>
                <h6>Chưa có tài khoản? &ensp;<span class="lien-ket" id="link-register">Tạo tài khoản</span> </h6>
            </div>

            <div id="box-register">
                <h3>Tạo tài khoản</h3>
                <h5>Yêu cầu điền thông tin chính xác</h5><br>
                <form action="{{URL::to('/dang-ki')}}" method="POST">
                    {{ csrf_field() }}
                <input name="registerfullname" type="text" class="input-text" placeholder="Họ tên đầy đủ...">
                @error('registerfullname')
                    <p style="color: red">{{$message}}</p>
                @enderror
                <input name="registeremail" type="text" class="input-text" placeholder="Địa chỉ email...">
                @error('registeremail')
                    <p style="color: red">{{$message}}</p>
                @enderror
                <input name="registerphonenumber" type="text" class="input-text" placeholder="Số điện thoại...">
                @error('registerphonenumber')
                    <p style="color: red">{{$message}}</p>
                @enderror
                <input name="registerusername" type="text" class="input-text" placeholder="Tên đăng nhập...">
                @error('registerusername')
                    <p style="color: red">{{$message}}</p>
                @enderror
                <input name="registerpassword" type="password" class="input-text" placeholder="Mật khẩu...">
                @error('registerpassword')
                    <p style="color: red">{{$message}}</p>
                @enderror
                <input name="registerretypepassword" type="password" class="input-text" placeholder="Nhập lại mật khẩu...">  
                @error('registerretypepassword')
                    <p style="color: red">{{$message}}</p>
                @enderror

                <button>Đăng Ký</button>
            </form>
                <h6>Đã có tài khoản? &ensp;<span class="lien-ket" id="link-login">Đăng nhập ngay</span> </h6>
            </div>
        </div>
    @else
    <div class="container-box-login container-cart">
        <a href="{{ URL::to('trang-ca-nhan', Session::get('hasLogged')) }}"><h5><i class="fa fa-user"> Trang cá nhân</i></h5></a>
        <center><h3>Giỏ hàng</h3></center>
        @if(!empty($cart))
            <div class="box-all-product-cart">
                <table>
                    <th>Sản phẩm</th>
                    <th></th>
                    <th>Phân loại</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>

                    {{-- Item --}}
                    @php $count_price=0; $count_segment=0; @endphp
                    @foreach($cart as $value)
                    <tr>
                        {{-- Pic --}}
                        <td>
                            <a href="{{ URL::to('chi-tiet-san-pham',$value->idProduct) }}"><img style="width: 80px; height: 70px;" src="{{ asset('laravel/shopbee/public/product/'.$value->firstImage) }}"></a>
                        </td>
                        {{-- Name --}}
                        <td><a href="{{ URL::to('chi-tiet-san-pham',$value->idProduct) }}">
                            @if(mb_strlen($value->nameProduct)> 20)
                                {{ substr($value->nameProduct, 0, 20)."..." }}
                            @else
                                {{ $value->nameProduct }}
                            @endif
                            </a>
                        </td>
                        {{-- Classify --}}
                        <td>{{ $value->phan_loai }} <h6 style="font-weight: normal; font-size:12px">+{{ number_format($value->tong_phu_thu) }}đ</h6></td>
                        {{-- Price --}}
                        <td>{{ $value->priceProduct }}</td>
                        {{-- Quantity --}}
                        <td>{{ $value->quantity }}</td>
                        {{-- Total --}}
                        <td style="font-weight: 600">{{ number_format($value->quantity*($value->priceProduct + $value->tong_phu_thu)) }}đ</td>
                        {{-- CRUD --}}
                        <td>
                            <a href="{{ URL::to('/xoa-khoi-gio',$value->idProduct) }}"><i class="fa fa-trash" style="color: red;font-size: 20px;"></i></a>&emsp;
                            <i class="fa fa-floppy-o" style="color: blue;font-size: 18px;"></i>
                        </td>
                        @php 
                            $count_price+= $value->quantity*($value->priceProduct + $value->tong_phu_thu);
                            $count_segment+= 1;
                        @endphp
                    </tr>                        
                    @endforeach
                    {{-- /Item --}}
                </table>
            </div>
            <div class="total-all">
                <a href="{{ URL::to('dat-hang',Session::get('hasLogged')) }}"><button>Mua Hàng</button></a>
                <h6>Tổng thanh toán ({{$count_segment}} sản phẩm): <span>{{number_format($count_price)}}</span></h6>
            </div>
        @else
        <center><h6>( Không có sản phẩm nào! )</h6></center>
        @endif
    </div>
    @endif
    <script>
        var link_register = document.getElementById('link-register');
        var box_register = document.getElementById('box-register');
        var link_login = document.getElementById('link-login');
        var box_login = document.getElementById('box-login');

        link_register.addEventListener('click', function onClick(event) {
            box_register.style.display = 'block'; 
            box_login.style.display='none';
        });
        link_login.addEventListener('click', function onClick(event) {
            box_register.style.display = 'none'; 
            box_login.style.display='block';
        });
    </script>
</body>
</html>