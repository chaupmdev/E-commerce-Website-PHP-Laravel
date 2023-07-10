@extends('masterlayout')
@section('content')
   <section class="new_arrivals_area section-padding-30 clearfix">
    <div class="main">
        <div class="nav-bar-home">
            <div class="nav-bar-child">  
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/user.png') }}">
                    <span>Thông tin cá nhân</span>
                </div>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/map.png') }}">
                    <span>Địa chỉ giao hàng</span>
                </div>
                <div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/checklist.png') }}">
                    <span>Quản lý đơn hàng</span>
                </div>
                <a href="{{ URL::to('dang-xuat') }}"><div class="item-nav-bar-child">
                    <img src="{{asset('laravel/shopbee/public/system/loggout.png') }}">
                    <span>Đăng xuất</span>
                </div></a>
            </div>
        </div>
        <div class="main-container">
            <div class="box-container box-information">
                <h6>Thông Tin Cá Nhân</h6>
                <div class="box-left-information"></div>
                <div class="box-right-information">
                    <table>
                        <th></th>
                        <th></th>
                        @foreach($account as $value)
                        <tr>
                            <td>Họ và tên:</td>
                            <td>{{ $value->fullName }}</td>
                        </tr>
                        <tr>
                            <td>Số điện thoại:</td>
                            <td>{{ $value->phoneNumber }}</td>
                        </tr>
                        <tr>
                            <td>Đia chỉ email:</td>
                            <td>{{ $value->email }}</td>
                        </tr>
                        <tr>
                            <td>Loại tài khoản:</td>
                            <td>{{ $value->namePermission }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-delivery-address">
                    <table>
                        <th>Tỉnh/Thành phố</th>
                        <th>Huyện/Quận</th>
                        <th>Xã/Phường</th>
                        <th>Địa chỉ cụ thể</th>
                        <th>Số điện thoại</th>
                        <th>Mặc định</th>
                        @foreach($delivery_address as $value)
                        <tr>
                            <td>{{ $value->nameProvine }}</td>
                            <td>{{ $value->nameDistrict }}</td>
                            <td>{{ $value->nameWard }}</td>
                            <td>{{ $value->detailAddress }}</td>
                            <td>{{ $value->phoneNumber }}</td>
                            <td>
                                @if($value->isDefault == 1)
                                    <input type="radio" name="isDefault" checked="true">
                                @else
                                    <input type="radio" name="isDefault">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <button>Lưu thay đổi</button>
                    <button id="add-delivery-address">Thêm địa chỉ</button> 
                                   
                </div>
                <div class="box-add-delivery-address" id="box-add-delivery-address">
                    <h5>Thông tin liên hệ</h5>
                    <div class="box-select-location">
                        <select class="select-location" id="province">
                            <option value="">Chọn Thành phố/Tỉnh</option>           
                        </select>
                                    
                        <select class="select-location" id="district">
                            <option value="">Chọn Quận/Huyện</option>
                        </select>
                        
                        <select class="select-location" id="ward">
                            <option value="">Chọn Phường/Xã</option>
                        </select>   
                    </div>    
                    <div class="box-select-location">
                        <input type="text" class="input-detail-address" placeholder="Nhập địa chỉ giao hàng cụ thể...">    
                        <input type="text" class="input-phone-number" placeholder="Số điện thoại nhận hàng...">    
                    </div> 
                    <div class="box-select-is-default">
                        <input type="checkbox" class="input-is-default"><h6>&ensp;Đặt làm mặc định</h6>
                    </div>             
                    <button>Thêm mới</button>
                    <button id="back-delivery-address">Hủy bỏ</button>
                </div>
                    
                <script>
                    var button = document.getElementById('add-delivery-address');
                    var cancel = document.getElementById('back-delivery-address');
                    var div = document.getElementById('box-add-delivery-address');                 
                    
                    button.addEventListener('click', function onClick(event) {
                        div.style.display = 'block'; 
                    });

                    cancel.addEventListener('click', function onClick(event) {
                        div.style.display = 'none'; 
                    });

                </script>    
                <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
                <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
                <script src="{{ asset('laravel/shopbee/public/FE/js/location.js') }}"></script>
                
            </div>
            <div class="box-container box-information">
                <h6>Tất cả đơn hàng</h6>
                <div class="box-all-condition">
                    <div class="item-condition">
                        <div class="item-condition-left" style="background: url({{ asset('laravel/shopbee/public/system/tt1.png') }}); background-size: cover;"></div>
                        <div class="item-condition-center">
                            <h3>5</h3>
                            <h6>Chờ xác nhận</h6>
                            
                        </div>
                        <div class="item-condition-right">
                            <p>Xem</p>
                        </div>
                    </div>
                    <div class="item-condition">
                        <div class="item-condition-left" style="background: url({{ asset('laravel/shopbee/public/system/tt2.png') }}); background-size: cover;"></div>
                        <div class="item-condition-center">
                            <h3>5</h3>
                            <h6>Đang xử lý</h6>
                            
                        </div>
                        <div class="item-condition-right">
                            <p>Xem</p>
                        </div>
                    </div>
                    <div class="item-condition">
                        <div class="item-condition-left" style="background: url({{ asset('laravel/shopbee/public/system/tt3.png') }}); background-size: cover;"></div>
                        <div class="item-condition-center">
                            <h3>5</h3>
                            <h6>Đang giao</h6>
                            
                        </div>
                        <div class="item-condition-right">
                            <p>Xem</p>
                        </div>
                    </div>
                    <div class="item-condition">
                        <div class="item-condition-left" style="background: url({{ asset('laravel/shopbee/public/system/tt4.png') }}); background-size: cover;"></div>
                        <div class="item-condition-center">
                            <h3>5</h3>
                            <h6>Đã giao</h6>
                            
                        </div>
                        <div class="item-condition-right">
                            <p>Xem</p>
                        </div>
                    </div>
                    <div class="item-condition">
                        <div class="item-condition-left" style="background: url({{ asset('laravel/shopbee/public/system/tt5.png') }}); background-size: cover;"></div>
                        <div class="item-condition-center">
                            <h3>5</h3>
                            <h6>Đã hủy</h6>
                            
                        </div>
                        <div class="item-condition-right">
                            <p>Xem</p>
                        </div>
                    </div>
                    <div class="item-condition">
                        <div class="item-condition-left" style="background: url({{ asset('laravel/shopbee/public/system/tt6.png') }}); background-size: cover;"></div>
                        <div class="item-condition-center">
                            <h3>5</h3>
                            <h6>Bị từ chối</h6>
                            
                        </div>
                        <div class="item-condition-right">
                            <p>Xem</p>
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
<style>
    .box-information{
        padding: 15px;
    }
    .box-left-information{
        width: 17%;
        height: 180px;
        border-radius: 50%;
        float: left; background-size: cover;
        background-image: url({{ asset('laravel/shopbee/public/system/user2.png') }});
    }
    .box-right-information{
        width: 81%;
        height: 180px;
        float: right;
        padding: 15px 0;
    }
    .box-right-information h6{
        margin-bottom:15px; font-weight: normal; font-family: Arial, Helvetica, sans-serif;
    }
    .box-right-information td{
        text-align: left;
        padding-left: 15px
    }
    .box-delivery-address{
        width: 100%;
        height: auto;
        float: left;
        margin-top: 20px;
    }
    .box-delivery-address table{width: 100%;}
    .box-delivery-address th{font-weight: 600}
    .box-delivery-address button{float: right;width: 150px; height: 35px;background-color: rgb(255, 166, 0); border-radius: 4px;font-size: 13px; color: white; font-weight: 300px;margin:15px 5px; border: none}
    .box-delivery-address button:last-child{background-color: #6b905c}
    .box-delivery-address button:last-child:hover{background-color: #A3BB98; transition: ease .4s; cursor: pointer;}
    .box-delivery-address button:hover{background-color: rgb(253, 205, 115); transition: ease .4s; cursor: pointer;}
    .box-delivery-address button:active{outline: none} .box-delivery-address button:focus{outline: none}
    .box-delivery-address td{border-bottom: 1px solid rgb(230, 228, 228)}
    .box-add-delivery-address{width: 100%; height: 220px; float: left; display: none}
    .box-add-delivery-address .select-location{width: 32.5%; float: left;}
    .box-add-delivery-address .box-select-location{width: 100%; height: 50px; display: flex; justify-content: space-between; align-items: center}
    .box-select-location input{border: 1px solid rgb(230, 229, 229); padding: 10px 10px; border-radius: 4px; float: left;} .box-select-location input:focus{outline: none}
    .box-select-location .input-detail-address{width: 66.25%;} .box-select-location .input-phone-number{width: 32.5%;}
    .box-select-is-default{padding-top: 10px; width: 100%; height: 25px;} .box-select-is-default h6{font-weight: normal; float: left; font-size: 14px}
    .box-select-is-default .input-is-default{width: 17px; height: 17px; float: left;}
    .box-add-delivery-address button{float: right;width: 150px; height: 35px;background-color: rgb(255, 166, 0); border-radius: 4px;font-size: 12px; color: white; font-weight: 300px;margin:15px 5px; border: none}
    .box-add-delivery-address button:last-child{background-color: #6b905c}
    .box-add-delivery-address button:last-child:hover{background-color: #A3BB98; transition: ease .4s; cursor: pointer;}
    .box-add-delivery-address button:hover{background-color: rgb(253, 205, 115); transition: ease .4s; cursor: pointer;}
    .box-add-delivery-address button:focus{outline: none}
    .box-all-condition {
        width: 100%; height: auto; display: grid; grid-template-columns: auto auto auto; gap:25px; 
    }
    .box-all-condition .item-condition{width: 100%; height: 70px; }
    .box-all-condition .item-condition .item-condition-left{ width: 70px; height: 70px; le; float: left;}
    .box-all-condition .item-condition .item-condition-center{width: 150px; height: 70px;  float: left; padding: 0 15px;}
    .box-all-condition .item-condition .item-condition-center h6{font-weight: normal;font-family: Arial, Helvetica, sans-serif}
    .box-all-condition .item-condition .item-condition-right{width: 100px; height: 70px; float: right;display: flex; justify-content: left; align-items: center}
    .box-all-condition .item-condition .item-condition-right p{color: black}.box-all-condition .item-condition .item-condition-right p:hover{color: rgb(141, 141, 141); cursor: pointer;}
</style>
