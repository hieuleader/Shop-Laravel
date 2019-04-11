@extends('includes.master')
@section('title','Giỏ Hàng')
@section('css')
@endsection
@section('content')

    <section class="container" style="margin-top: 20px;">

        <div class="content-push">

            <div class="breadcrumb-box">
                <a href="{{url('/')}}">Home</a>
                <a href="{{url('/cart')}}">Giỏ Hàng</a>
            </div>
            @if(Session::has('message'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="information-blocks">
                <div class="table-responsive">
                    <table class="cart-table">
                        <tr>
                            <th class="column-1">Tên Sản Phẩm</th>
                            <th class="column-2">Đơn Giá</th>
                            <th class="column-3">Số Lượng</th>
                            <th class="column-4">Tổng tiền</th>
                            <th class="column-5"></th>
                        </tr>
                        <tr id="cartempty"></tr>
                        <tbody id="ListCart">
                        </tbody>
                    </table>
                </div>
                <div class="cart-submit-buttons-box">
                    <div class="row" style="margin: 0">
                        <div class="cart-summary-box pull-right col-md-6" style="margin: 0">
                            <div class="grand-total">Thành Tiền : <span id="grandtotal">{{Cart::total()}}</span></div>
                            <a class="col-md-6 pull-right button style-10" href="">Thanh Toán</a>
                            <a class="col-md-5 pull-right button style-10" href="">Tiếp tục mua hàng</a>
                        </div>
                        <div class="cart-summary-box pull-left col-md-3" style="margin: 0">
                            <div class="grand-total">Mã giảm giá  <span id="grandtotal"></span></div>
                            
                           <input type="text" class="form-control pull-left">
                           <a class="col-md-6 pull-right button style-10" href="" style="margin-top:15px;">Xác nhận</a>
                        </div>
                    </div>
                </div>
        </div>

    </section>
@section('javascript')
@endsection
@stop

@section('footer')
<script>
    $(document).ready(function(){
        loadCart();
    });

 </script>
@stop