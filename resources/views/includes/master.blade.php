<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="http://123.16.70.151/Shop-Laravel/public/" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Cửa hàng thời trang Híu Mai =))" />
    <meta property="og:description" content="CĐG cũng có ở trong này hiiiii" />
    <meta property="og:image" content="https://scontent.fhan3-3.fna.fbcdn.net/v/t1.0-9/54800107_1321249651346428_4367508799708200960_n.jpg?_nc_cat=100&_nc_oc=AQnVLBBVPGrro6aS-3bhngAJG3lzOvP5fQaMW3tcw3gnSkY9h3y2Vq9YzsbOvHR7BVY&_nc_ht=scontent.fhan3-3.fna&oh=38254249396eb5c6d64c3fd76b24daae&oe=5D2E56AC"
    />
    <link rel="icon" href="{{url('/')}}/assets/images/logo/avatar_null_nonecircle.png" />
    <title>@yield('title')</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/font-awesome.css')}}" rel="stylesheet">
    
    <link href="{{ URL::asset('assets/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/idangerous.swiper.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{URL::asset('assets/css/mycss.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/genius1.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/genius-slider.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/genius-gallery.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('@styleadmin/node_modules/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
    <link href="{{ URL::asset('assets/css/lightbox.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('@styleadmin/css/algolia.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/animate.min.css')}}" rel="stylesheet">

    <!-- Inject CSS -->
    @yield('css')
</head>

<body>
    <div id="cover"></div>
    <div class="theme2">
        <div id="content-block">
            <div class="content-center fixed-header-margin">
                <!-- HEADER -->
    @include('includes.header')
            </div>
            <div class="clear"></div>
            @yield('content')
        </div>
    @include('includes.footer')
    @include('includes.cart')
        <div class="search-box popup">
            <div class="aa-input-container" id="aa-input-container">
                <input type="search" id="aa-search-input" class="aa-input-search" placeholder="Tìm kiếm sản phẩm" name="search" autocomplete="off"
                />
                <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                    <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                </svg>
            </div>
        </div>
    </div>
    <script>
        var mainurl = '{{url('/')}}';
    </script>
    <!-- jQuery -->

    <script src="{{ URL::asset('assets/js/jquery.js')}}"></script>
    <script src="{{ URL::asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/wow.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.smooth-scroll.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->

    <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
    {{--
    <script src="{{ URL::asset('assets/js/lightbox.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/plugins.js')}}"></script>--}}
    <script src="{{ URL::asset('assets/js/genius.js')}}"></script>
    <script src="{{ URL::asset('assets/js/genius-slider.js')}}"></script>


    <script src="{{ URL::asset('assets/js/idangerous.swiper.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/global.js')}}"></script>
    <!-- custom scrollbar -->
    <script src="{{asset('@styleadmin/node_modules/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
    <script src="{{asset('@styleadmin/js/toastDemo.js')}}"></script>
    <script src="{{ URL::asset('assets/js/algoliasearch.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/autocomplete.min.js')}}"></script>
    <script src="{{asset('@styleadmin/js/pusher.min.js')}}"></script>
    <script src="{{asset('@styleadmin/js/myjs.js')}}"></script>
    

    <!-- js Page -->
    @yield('javascript'); @yield('footer');
    <script>
        new WOW().init();
    </script>
   
    <script>
        $(window).load(function(){
            setTimeout(function(){
                $('#cover').fadeOut(100);
            },100)
            loadCart();
        });



    $("#LoginButton").click(function(){
        var mail = $('#email').val();
        var pw = $('#password').val();
        var dataString = "email="+mail+"&password="+pw;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: '{{route('user.login')}}',
            data:dataString,
            success: function (data) {
                ToastSuccess(data.success); 
                location.reload(true);

            },
            error: function (request, status) {
               
                $.each(request.responseJSON.errors,function(key,val){
                    ToastError(val);
                });
            }
        });
    });

    $("#SignUpButton").click(function(){
        var name = $('#nameR').val();
        var email = $('#emailR').val();
        var Address = $('#AddressR').val();
        var Phone = $('#PhoneR').val();
        var password = $('#passwordR').val();
        var dataString = "name="+name+"&password="+password+"&email="+email+"&Address="+Address+"&Phone="+Phone;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: '{{route('user.signup')}}',
            data:dataString,
            success: function (data) {
                ToastSuccess(data.success); 
                location.reload(true);

            },
            error: function (request, status) {
               
                $.each(request.responseJSON.errors,function(key,val){
                    ToastError(val);
                });
            }
        });
    });

    function loadCart(){
        $.ajax({
        headers: {
            'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
        },
        method: 'GET',
        url: '{{route('cart.show')}}',
        dataType: 'json',
            success: function(data) {
              $('#ListCart').html(data.list);
              $('#grandtotal').html(data.total);
              $('#carttotal').html('('+data.count+')');
              $('#goCart').html(data.cartPopup);
              $('#grandttl').html(data.total);
              $('#MaGiamGia').html(data.MaGiamGia);
              $('#cartCheckOut').html(data.cartCheckout);
              $('#infoShiper').html(data.Shiper);
            },
            error: function(html, status) {
                $.each(request.responseJSON.errors,function(key,val){
                    ToastError(val);
                });
            }
        });
    }

    $(document).ready(function(){
        $('#btnAddProduct').click(function(){
            var $this = $(this);
            $this.button('loading');
                setTimeout(function() {
                $this.button('reset');
            }, 1000);
            var cart_idProduct = $('#modalIdProduct').val();
            var cart_number = $('#modalSoLuong').text();
            var cart_idSize = $('#selSize').val();
            var rdoColor = $("input[name=rdoColor]");
            var rdoValue = rdoColor.filter(":checked").val();
            dataString = "idProduct="+cart_idProduct+"&Number="+cart_number+"&idSize="+cart_idSize
            +"&idColor="+rdoValue;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: '{{route('cart.store')}}',
                data:dataString,
                success: function (data) {
                    setTimeout(function(){
                        ToastSuccess(data.success);
                    }, 800);
                },
                error: function (request, status) {
          
                    $.each(request.responseJSON.errors,function(key,val){
                        ToastError(val);
                    });
                }
            });
        });
    });
    jQuery(document).ready(function($) {
        "use strict";
        $('#customers-testimonials').owlCarousel( {
            loop: true,
            center: true,
            items: 3,
            margin: 30,
            autoplay: true,
            dots:true,
            nav:true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        });

        $('#coupons').owlCarousel( {
            loop: true,
            center: true,
            items: 3,
            margin: 30,
            autoplay: true,
            dots:true,
            nav:true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        });

    });



    $(document).on('click','.remove-button',function(){
        var row_id = $(this).attr('data-rowId');
        deleteCart(row_id);
        
    });

    $('.btnCheck').click(function(){
       
    });

    function deleteCart(row_id){
        $.ajax({
        headers: {
            'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '{{route('cart.destroy')}}',
        data:{rowid:row_id},
        dataType: 'json',
            success: function(data) {
                setTimeout(function(){
                    ToastSuccess(data.success);
                }, 800);
            },
            error: function(request, status) {
                $.each(request.responseJSON.errors,function(key,val){
                    ToastError(val);
                });
            }
        });
    }

    function btnCheckOut(){
       
    }
    </script>
</body>
<div class="zalo-chat-widget" data-oaid="3261362199566416167" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0"
    data-width="350" data-height="420"></div>

{{-- <script src="https://sp.zalo.me/plugins/sdk.js"></script> --}}

{{VisitLog::save()}}

</html>