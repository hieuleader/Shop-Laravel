@extends('includes.master') 
@section('title','Shop Quần Áo HieuMai')
@section('css')
<style>
.item-details img {
    width:220px;
    height:220px;
}
.item-details:hover {
  box-shadow: 0 10px 50px rgba(33,33,33,.2); 
}


</style>
<link rel="stylesheet" href="{{asset('@styleadmin/css/attribute.css')}}">
@endsection
@section('content')
<section class="go-slider">
    <div id="bootstrap-touch-slider" class="carousel bs-slider fade control-round indicators-line" data-ride="carousel" data-pause="hover"
        data-interval="5000">
        <!-- Wrapper For Slides -->
        <div class="carousel-inner" role="listbox">
        </div>
        <!-- End of Wrapper For Slides -->

        <!-- Left Control -->
        <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <!-- Right Control -->
        <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
    <!-- End  bootstrap-touch-slider Slider -->

</section>
<section class="wow fadeInUp go-services hideme">
    <div class="row" style="margin-top:70px;">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div id="scrollvaoday"></div>
                <div class="section-title">
                    <h2>Dịch vụ của chúng tôi</h2>
                    <p>ShopTMĐT</p>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="service-list text-center wow fadeInUp">
                    <img src="{{url('/assets/images/service')}}/jz52.jpg" alt="">
                    <h3>Giao dịch nhanh chóng</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="service-list text-center wow fadeInUp">
                    <img src="{{url('/assets/images/service')}}/jz52.jpg" alt="">
                    <h3>Sản phẩm chất lượng</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="service-list text-center wow fadeInUp">
                    <img src="{{url('/assets/images/service')}}/jz52.jpg" alt="">
                    <h3>Hệ thống chuyên nghiệp</h3>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $CountForm = 0; ?>
<section class="wow fadeInUp go-products">
    <div class="container">
        <div class="row">
            <!-- Nav tabs -->
            <div class="card">
                <!-- Tab panes -->
                <div class="tab-content">
                        <ul class="nav nav-tabs home-tab" role="tablist">
                            <li class="active"><a>Nổi Bật</a></li>
                        </ul>
                        <div class="row">
                            @foreach($features as $product)
                            <?php $CountForm++; ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid4">
                                    <div class="product-image4">
                                        <a href="{{url('/san-pham')}}/{{$product->id}}/{{$product->slug}}">
                                            <img src="{{url('/images/thumbnail')}}/{{$product->thumbnail}}">
                                        </a>

                                        @if($product->discount>0)
                                        <span class="product-discount-label">-{{$product->discount}}%</span>
                                        @endif
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{url('/san-pham')}}/{{$product->id}}/{{$product->slug}}">{{$product->title}}</a></h3>
                                        <div class="price">
                                            @if($product->discount > 0)
                                            {{$product->formatMoney($product->priceDiscount($product->cost,$product->discount))}}₫
                                            <span>{{$product->formatMoney($product->cost)}}₫</span>
                                            @else
                                            {{$product->formatMoney($product->cost)}}₫
                                            @endif
                                        </div>
                                        <form id="product{{$CountForm}}">
                                            <input type="hidden" name="title" value="{{$product->title}}">
                                            <input type="hidden" name="img" value="{{$product->thumbnail}}">
                                            <input type="hidden" name="description" value="{{$product->description}}">
                                            <input type="hidden" name="discount" value={{$product->discount}}>
                                            <input type="hidden" name="price" value="{{$product->formatMoney($product->priceDiscount($product->cost,$product->discount))}}">
                                            <input type="hidden" name="idproduct" value="{{$product->id}}">
                                            <button class="add-to-cart" type="button" data-product="{{$CountForm}}" >Thêm vào giỏ</button>
                                        </form>
                                        
                                    </div>
                                </div>
                                
                                
                            </div>
                            @endforeach
                        </div>
                        <br/><br/>
                        <ul class="nav nav-tabs home-tab" role="tablist">
                                <li class="active"><a>Mới Nhất</a></li>
                        </ul>
                        <div class="row">
                            @foreach($lastes as $product)
                            <?php $CountForm++; ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid4">
                                    <div class="product-image4">
                                        <a href="{{url('/san-pham')}}/{{$product->id}}/{{$product->slug}}">
                                            <img src="{{url('/images/thumbnail')}}/{{$product->thumbnail}}">
                                        </a>
     
                                        <span class="product-new-label">New</span>
                                        @if($product->discount>0)
                                        <span class="product-discount-label">-{{$product->discount}}%</span>
                                        @endif
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{url('/san-pham')}}/{{$product->id}}/{{$product->slug}}/">{{$product->title}}</a></h3>
                                        <div class="price">
                                            @if($product->discount > 0)
                                            {{$product->formatMoney($product->priceDiscount($product->cost,$product->discount))}}₫
                                            <span>{{$product->formatMoney($product->cost)}}₫</span>
                                            @else
                                            {{$product->formatMoney($product->cost)}}₫
                                            @endif
                                        </div>
                                        <form id="product{{$CountForm}}">
                                        <input type="hidden" name="title" value="{{$product->title}}">
                                        <input type="hidden" name="img" value="{{$product->thumbnail}}">
                                        <input type="hidden" name="description" value="{{$product->description}}">
                                        <input type="hidden" name="discount" value={{$product->discount}}>
                                        <input type="hidden" name="price" value="{{$product->formatMoney($product->priceDiscount($product->cost,$product->discount))}}">
                                        <input type="hidden" name="idproduct" value="{{$product->id}}">
                                        <button class="add-to-cart" type="button" data-product="{{$CountForm}}">Thêm vào giỏ</button>
                                        </form>
                                        
                                    </div>
                                </div>
                                
                                
                            </div>
                            @endforeach
                        </div>
                        <br/><br/>
                    <ul class="nav nav-tabs home-tab" role="tablist">
                        <li class="active"><a>Khuyến Mãi</a></li>
                    </ul>
                    <div class="row">
                            @foreach($discounts as $product)
                            <?php $CountForm++; ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid4">
                                    <div class="product-image4">
                                        <a href="{{url('/san-pham')}}/{{$product->id}}/{{$product->slug}}">
                                            <img src="{{url('/images/thumbnail')}}/{{$product->thumbnail}}">
                                        </a>

                                        
                                        @if($product->discount>0)
                                        <span class="product-discount-label">-{{$product->discount}}%</span>
                                        @endif
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{url('/san-pham')}}/{{$product->id}}/{{$product->slug}}/">{{$product->title}}</a></h3>
                                        <div class="price">
                                            @if($product->discount > 0)
                                            {{$product->formatMoney($product->priceDiscount($product->cost,$product->discount))}}₫
                                            <span>{{$product->formatMoney($product->cost)}}₫</span>
                                            @else
                                            {{$product->formatMoney($product->cost)}}₫
                                            @endif
                                        </div>
                                        <form id="product{{$CountForm}}">
                                        <input type="hidden" name="title" value="{{$product->title}}">
                                        <input type="hidden" name="img" value="{{$product->thumbnail}}">
                                        <input type="hidden" name="description" value="{{$product->description}}">
                                        <input type="hidden" name="discount" value={{$product->discount}}>
                                        <input type="hidden" name="price" value="{{$product->formatMoney($product->priceDiscount($product->cost,$product->discount))}}">
                                        <input type="hidden" name="idproduct" value="{{$product->id}}">
                                        <button type="button" class="add-to-cart"  data-product="{{$CountForm}}">Thêm vào giỏ</button>
                                        </form>
                                        
                                    </div>
                                </div>
                                
                               
                            </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wow fadeInUp testimonials hideme" id="Coupons">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="section-title">
                    <ul class="nav nav-tabs home-tab" role="tablist">
                        <li class="active"><a>Mã giảm giá</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12">
                <div id="coupons" class="owl-carousel">
                    @foreach($coupons as $cp)
                    <div class="coupon">
                        <img src="{{url('/')}}/images/product/sale.png" alt="Avatar">
                        <div class="MaGiamGia" style="background-color:white">
                          <b>{{$cp->title}}</b>
                          <p>{{$cp->content}}</p>
                        </div>
                        <div class="MaGiamGia">
                          <p>Mã: <span class="promo code">{{$cp->code}}</span></p>
                          <p>Giảm: <span class="promo">{{$cp->Percent}}%</span></p>
                          <p>Đối với đơn hàng: > <font color="green"><b>{{formatMoney($cp->RequireTotal,true)}}đ</b></font></p>
                          <p class="expire">HSD: Còn {{formatDateTime($cp->Date)}}</p>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="wow fadeInUp testimonials hideme">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="section-title">
                    <ul class="nav nav-tabs home-tab" role="tablist">
                        <li class="active"><a>Thương Hiệu</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12">
                <div id="customers-testimonials" class="owl-carousel">
                    @forelse ($brands as $item)
                        <div class="item">
                            <div class="shadow-effect">
                                <div class="item-details">
                                   <a href="san-pham?brands={{$item->slug}}"><img src="{{url('/images/branch/')}}/{{$item->thumbnail}}"></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="item">
                            <div class="shadow-effect">
                                <i class="fa fa-quote-right"></i>
                                <div class="item-details">
                                    <p>Không có dữ liệu</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wow fadeInUp testimonials hideme">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="section-title">
                    <ul class="nav nav-tabs home-tab" role="tablist">
                        <li class="active"><a>Tin Tức</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12">
                <div id="news" class="owl-carousel">
                    @forelse ($news as $item)
                    <div class="item">
                        <div class="shadow-effect">
                            <div class="item-details">
                                <a href="tin-tuc/{{$item->slug}}"><img src="images/news/{{$item->thumbnail}}">
                                <p class="titlenews">{{$item->title}}</p></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="item">
                        <div class="shadow-effect">
                            <i class="fa fa-quote-right"></i>
                            <div class="item-details">
                                <p>Không có dữ liệu</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END OF TESTIMONIALS -->
<!-- MODAL -->
@include('includes.modalproduct')
@section('javascript')
@include('includes.scriptproduct')


@endsection




@stop 
@section('footer')
<script>

</script>
@stop