<?php
use Illuminate\Support\Facades\Schema;
use App\Notification;
use Intervention\Image\ImageManagerStatic as Image;
use App\Pages;
use Algenza\Cosinesimilarity\Cosine;
use Phpml\Classification\KNearestNeighbors;
use App\Review;
use Mail;
use App\CustomClass\NganLuong;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['fw-block-attacks']], function () {


Route::get('/', 'FrontEndController@index')->name('front.index');
Route::post('/reg','SubcriberController@store')->name('subcriber.store');
/* MODULE FB SERVICE */
Route::get('getapi/minmax/{min}/{max}', 'ApiController@minmax')->name('getapi.minmax');
Route::get('getapi/service/{msg}', 'ApiController@service')->name('getapi.service');
/* MODULE PRODUCT */
Route::get('san-pham', 'FrontEndController@category2')->name('front.category');
Route::get('fetchdata/colorforsize', 'FrontEndController@fetchColor')->name('front.fetchcolor');
Route::get('fetchdata/size', 'FrontEndController@fetchSize')->name('front.fetchsize');
Route::get('/san-pham/{id}/{slug}', 'FrontEndController@productDetails');

/* MODULE NEWS */
Route::get('tin-tuc/{slug}','FrontEndController@news')->name('news.load');

/* MODULE CART  */
Route::get('cart', 'CartController@cart')->name('cart.index');
Route::post('cart/store', 'CartController@store')->name('cart.store');
Route::post('cart/destroy', 'CartController@destroy')->name('cart.destroy');
Route::get('cart/load', 'CartController@show')->name('cart.show');
Route::post('cart/addcoupons', 'CartController@addCoupon')->name('cart.addcoupon');
Route::post('cart/removecoupons', 'CartController@removeCoupon')->name('cart.removecoupon');
Route::post('cart/checkout', 'CartController@checkout')->name('cart.checkout');
Route::post('cart/updatenumber', 'CartController@updateNumber')->name('cart.update');

/* MODULE WISHLIST */
Route::get('wishlist','WishlistController@wishlist')->name('wishlist.index');
Route::post('wishlist/store', 'WishlistController@store')->name('wishlist.store');
Route::get('wishlist/load', 'WishlistController@show')->name('wishlist.show');
Route::post('wishlist/destroy', 'WishlistController@destroy')->name('wishlist.destroy');
Route::post('wishlist/tocart','WishlistController@tocart')->name('wishlist.tocart');

/* MODULE CHECKOUT */
Route::get('checkout', 'CheckOutController@index')->name('checkout.index');
Route::post('checkout/order', 'CheckOutController@postOrder')->name('checkout.order');
Route::get('checkout/bill/{token}', 'BillController@getDetailsbyId')->name('bill.detais');
Route::get('checkout/paymentWall','CheckOutController@paymentWall')->name('bill.paymentwall');
Route::post('checkout/verifyPaypal', 'BillController@verifyPaypal')->name('bill.verifypaypal');
Route::get('checkout/redirectback', function(){
    if(Session::has('url')){
    return redirect(Session::get('url'));
    }else {
        return redirect()->back();
    }
    
});
/* CHECK SESSION */
Route::get('session/idship/{id}', 'CartController@infoShiper');

/* MODULE REVIEW */
Route::get('reviews','ReviewController@fetch')->name('review.fetch');
Route::post('reviews','ReviewController@store')->name('review.store');

/* MODULE USER */
Route::post('/users/login', 'FrontEndController@loginPost')->name('user.login');
Route::get('/users/logout', 'FrontEndController@logoutIndex')->name('front.logout');
Route::post('/users/signup', 'FrontEndController@signUpPost')->name('user.signup');
Route::get('/forgot','FrontEndController@forgotview');
Route::post('/forgot','Auth\ForgotPasswordController@sendmailForgot')->name('user.forgot');
Route::get('/users/forgotpass/tokenauth/{token}','Auth\ForgotPasswordController@forgotconfirm');
Route::post('/forgot/accept', 'Auth\ForgotPasswordController@forgotaccept')->name('forgot.accept');

Route::group(['prefix' => 'users', 'middleware' => 'frontLogin'], function () {
    Route::get('/', 'UsersProfileController@index')->name('profile.index');
    Route::post('/users/update', 'UsersProfileController@update')->name('profile.update');
    Route::post('/users/changepass', 'UsersProfileController@changePass')->name('profile.changepass');
});


/* MODULE SOCIAL LOGIN */
Route::get('/redirect/{social}', 'SocialFacebook@redirectToProvider')->name('facebook.login');;
Route::get('/callback/{social}', 'SocialFacebook@handleProviderCallback');


/* AUTH LOGIN BACKEND */
Route::get('/admin/login', 'AdminPages@loginIndex');
Route::post('/admin/login', 'AdminPages@loginPost')->name('admin.login');
Route::get('/admin/logout', 'AdminPages@logoutIndex');


/* AUTH SAFEMODE */
Route::get('/admin/safemode/tokenauth/{token}', 'SafeModeController@rememberauth');
Route::get('/admin/safemode/tokenauth/enable/{token}', 'SafeModeController@turnOnSafe');
});
Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
    Route::get('/bpc', function () {
        return view('admin.funcBPC');
    });

    Route::get('/', function () {
        return redirect('/admin/index');
    });
    Route::get('/index', 'AdminPages@index')->name('admin.index');
    Route::get('/bpc', 'AdminPages@bpc')->name('admin.bpc');
    Route::get('/kanban', 'AdminPages@kanban');
    Route::get('/erd', 'AdminPages@erd');
    Route::get('/fetchProduct', 'AdminPages@fetchTopProduct')->name('admin.fetchproduct');

    /* CONFIG */
    Route::get('/config','SettingsController@index');
    Route::post('/config/ui','SettingsController@updateui')->name('admin.config.update.ui');
    Route::post('/config/sociallinks','SettingsController@sociallinks')->name('admin.config.update.sociallinks');
   
    /* SOCIAL MODULE */
    Route::get('/social/zalo', 'ZaloSocial@index')->name('admin.zalo.index');
    Route::get('/social/zalo/getfriends', 'ZaloSocial@getFriends')->name('zalo.getfriend');
    Route::get('/social/zalo/getinfo', 'ZaloSocial@getInfo')->name('zalo.getinfo');
    Route::post('/social/zalo/sharelink','ZaloSocial@shareLink')->name('zalo.sharelink');

    Route::get('/social/facebook','GraphController@index')->name('admin.facebook.index');
    Route::get('/social/facebook/fetch','GraphController@fetch')->name('admin.facebook.fetch');
    Route::post('/social/facebook/scanemail','GraphController@scanEmail')->name('admin.facebook.scanemail');
    Route::post('/social/facebook/scanoption', 'GraphController@scanOption')->name('admin.facebook.scanoption');
    

    

    /* SAFE MODE */
    Route::post('safemode/alertlog','SafeModeController@AlertLogin')->name('admin.safemode.alertlogin');
    
    Route::group(['prefix' => 'safemode', 'middleware' => 'safeMode'], function () {
        Route::get('config', 'SafeModeController@config')->name('admin.safemode.config');
        Route::get('database', 'SafeModeController@database')->name('admin.safemode.dbview');
        Route::get('fetch', 'SafeModeController@dbfetch')->name('admin.safemode.db.fetch');
        Route::post('database/backup', 'SafeModeController@dbBackup')->name('admin.safemode.db.backup');
        Route::post('database/restore', 'SafeModeController@dbRestore')->name('admin.safemode.db.restore');
        Route::get('secrect', 'SocialController@index')->name('admin.zalo.index');
        Route::post('kenhbanhang/updatezalo', 'SocialController@updateZalo')->name('admin.zalo.update');
        Route::post('kenhbanhang/updatefacebook', 'SocialController@updateFacebook')->name('admin.facebook.update');
        Route::post('updatesystem','SafeModeController@updateSystem')->name('admin.safemode.system.update');
        Route::post('admin/changepass','SafeModeController@changePass')->name('admin.safemode.changepass');
    });
   
    /* USER BACKEND */
    Route::get('users', 'UserController@index')->name('users.list');
    Route::get('users/fetch', 'UserController@fetchAll')->name('users.fetch');
    Route::post('users/update', 'UserController@update')->name('users.update');
    Route::post('users/store', 'UserController@store')->name('users.store');

    /** Category Backend */
    Route::get('category', 'CategoryController@index')->name('category.list');
    Route::get('category/Search', 'CategoryController@Search')->name('category.search');
    Route::post('category', 'CategoryController@Store')->name('category.store');
    Route::get('category/delete/{id}', 'CategoryController@destroy')->name('category.destroy');
    Route::post('category/update', 'CategoryController@update')->name('category.update');

    /**SubCategory Backend */
    Route::get('subcategory/Search', 'SubCategoryController@Search')->name('subcategory.search');
    Route::post('subcategory', 'SubCategoryController@store')->name('subcategory.store');
    Route::post('subcategory/update', 'SubCategoryController@update')->name('subcategory.update');
    Route::get('subcategory/delete/{id}', 'SubCategoryController@destroy')->name('subcategory.destroy');
    /** Attribute Product */
    Route::get('chatlieu/Search', 'ChatLieuController@search')->name('chatlieu.search');
    Route::post('chatlieu', 'ChatLieuController@Store')->name('chatlieu.store');

    Route::get('color/Search', 'ColorController@search')->name('color.search');
    Route::post('color/Store', 'ColorController@store')->name('color.store');

    Route::get('size/Search', 'SizeController@search')->name('size.search');

    /** Coupons Backend */
    Route::get('coupons/', 'CouponsController@index')->name('coupons.list');
    Route::post('coupons/index', 'CouponsController@store')->name('coupons.store');
    Route::get('coupons/Search', 'CouponsController@search')->name('coupons.search');


    /** Product Backend */
    Route::get('product/add-product', 'ProductController@create')->name('product.create');
    Route::get('product/home', 'ProductController@index')->name('product.list');
    Route::get('product/fetch','ProductController@fetch')->name('product.fetch');
    Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::get('product/attribute', 'AdminPages@attIndex')->name('product.att.list');
    Route::get('product/brand', 'BrandController@index')->name('brand.home');
    Route::get('product/brand/list','BrandController@show')->name('brand.show');
    Route::post('product/brand', 'BrandController@store')->name('brand.store');
    Route::post('product/brand/update','BrandController@update')->name('brand.update');
    Route::get('product/brand/fetch','BrandController@fetch')->name('brand.fetch');
    Route::post('product/postfacebook','GraphController@publishToPage')->name('product.upfacebook');

    /** News BackEnd */
    Route::get('news/tintuc','NewsController@index')->name('news.list');
    Route::get('news/fetch','NewsController@fetch')->name('news.fetch');
    Route::get('news/add-news','NewsController@create')->name('news.create');
    Route::get('news/edit/{id}','NewsController@edit')->name('news.edit');
    Route::post('news/add-news','NewsController@store')->name('news.store');
    Route::post('news/edit/{id}','NewsController@update')->name('news.update');
    Route::get('news/delete/{id}', 'NewsController@destroy')->name('news.destroy');
    Route::get('news/sendmail/{id}','NewsController@sendmail');


    Route::get('notification/getcount', 'NotificationController@getAllCountNotify')->name('notif.countall');
    Route::get('notification/del', function () {
        Notification::query()->update(['seen' => 1]);
    })->name('notif.del');

    

    /** Product Details Backend */
    Route::post('productdetails', 'ProductDetailsController@store')->name('productdetails.store');
    Route::post('productdetails/update/{id}', 'ProductDetailsController@update')->name('productdetails.update');
    
    /** Bill Backend */
    Route::get('bill/list', 'BillController@show')->name('bill.show');
    Route::get('bill/fetch', 'BillController@fetchAll')->name('bill.fetch');
    Route::post('bill/updateStatus', 'BillController@updateStatus')->name('bill.updateStatus');
    Route::get('bill/details/{id}', 'BillController@showbillbyId');

    /** Menu Backend */
    Route::get('menu','PagesController@index')->name('pages.index');
    Route::get('menu/fetch','PagesController@fetch')->name('pages.fetch');
    Route::get('menu/fetchdb','PagesController@fetchDb')->name('pages.fetchdb');
    Route::post('menu/update','PagesController@update')->name('pages.update');
    Route::post('menu/store','PagesController@store')->name('pages.store');
    Route::post('menu/updaterecord','PagesController@updaterecord')->name('pages.updaterecord');

    /** Shiper Backend */
    Route::get('shipper', 'ShipperController@index')->name('shipper.list');
    Route::get('shipper/fetch', 'ShipperController@fetchAll')->name('shipper.fetch');
    Route::post('shipper/update', 'ShipperController@update')->name('shipper.update');
    Route::post('shipper/store', 'ShipperController@store')->name('shipper.store');

    /** Review Backend */
    Route::get('reviews','ReviewController@index')->name('review.list');
    Route::get('reviews/fetchBackend','ReviewController@fetchBackend')->name('review.fetchbackend');
    Route::get('reviews/delete/{id}', 'ReviewController@destroy')->name('review.destroy');


    /** Slide Backend */
    Route::get('slide/danh-sach','SlideController@index')->name('slide.index');
    Route::get('slide/fetch','SlideController@fetch')->name('slide.fetch');
    Route::get('slide/addslide','SlideController@create');
    Route::post('slide/store','SlideController@store')->name('slide.store');
    Route::get('slide/edit/{id}','SlideController@edit')->name('slide.edit');
    Route::post('slide/edit/{id}','SlideController@update')->name('slide.update');
    Route::get('slide/delete/{id}','SlideController@destroy')->name('slide.destroy');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    

    
});




Route::get('/clearcache', function () {
    Cache::flush();
   
});
Route::get('/add',function(){
    Schema::table('slides', function ($table) {
        $table->softDeletes();
    });
});


Route::get('fb',function(){
    $data = Pages::all();
    dd($data->find(1));
});

Route::get('cos', function () {
    $a = [0];
    $b = [0];
    $c = [5,4,7,4,7];
    $d = [7,1,7,3,8];
    echo Cosine::similarity($a,$b);
    echo "<br/>".Cosine::similarity($a,$b);
    
// return 'b'
});

Route::get('testmail',function(){
    Mail::send('emails.attachdb', ['title' => 'Thông tin tài khoản tại cửa hàng ShopHieuMai'], function ($message) {
        $message->from('hieumai@rog.vn', 'Trung Hieu');
        $message->to('adminsys@gmail.com');
        $path = storage_path('/app/backups/newlarvuejs_20190502181013.sql');
        $message->attach($path);
    });
});

Route::get('return/nganluong/{token}',function($token){
    $nlcheckout = new NganLuong;
    $nl_result = $nlcheckout->GetTransactionDetail($token);

    if ($nl_result) {
        $nl_errorcode           = (string)$nl_result->error_code;
        $nl_transaction_status  = (string)$nl_result->transaction_status;
        if ($nl_errorcode == '00') {
            if ($nl_transaction_status == '00') {
                //trạng thái thanh toán thành công
                echo "<pre>";
                print_r($nl_result);
                echo "</pre>";
                echo "Cập nhật trạng thái thành công";
            }
        } else {
            echo $nlcheckout->GetErrorMessage($nl_errorcode);
        }
    }
});

Route::get('/createdthumbnail',function(){

    $mime = Image::make('images/sliders/jDAr_01.jpeg')->encode('jpg', 75);


    return $mime->response();
});

Route::get('viewlist', function () {
    return view('forgotform');
});