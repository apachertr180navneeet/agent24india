<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Front;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('storage:link');
    $exitCode = Artisan::call('permission:cache-reset');
    return "All cache is cleared";
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});

Route::get('/call-migrate', function () {
    $exitCode = Artisan::call('migrate');    
    return "All migrations run";
});

Route::get('/run-seeder/{seeder}', function ($seeder) {
    $exitCode = Artisan::call('db:seed '.$seeder);    
    return "$seeder run";
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/', [Admin\Auth\LoginController::class, "index"])->name('login');
    Route::post("/login", [Admin\Auth\LoginController::class, "authenticate"])->name("login.post");
    Route::get("/forgot-password", [Admin\Auth\ForgotPasswordController::class, "index"])->name("forgotPassword");
    Route::post("/forgot-password", [Admin\Auth\ForgotPasswordController::class, "sendForgotPasswordMail"])->name("forgotPassword.post");
    Route::get("/logout", [Admin\Auth\LoginController::class, "destroy"])->name("logout");

    Route::middleware(["checkadminauth"])->group(function(){
        Route::get("/dashboard", [Admin\DashboardController::class, "index"])->name("dashboard")->middleware('permission:View Dashboard');

        Route::prefix("profile")->group(function(){
            Route::get("/", [Admin\ProfileController::class, "index"])->name("admin.profile.index");
            Route::post("/update", [Admin\ProfileController::class, "update"])->name("admin.profile.update");
        });

        Route::prefix("users")->group(function(){
            Route::get("/", [Admin\UserController::class, "index"])->name("users.index");
            Route::get('/get-users', [Admin\UserController::class, 'getUsers'])->name('users.getUsers');
            Route::get("/create", [Admin\UserController::class, "create"])->name("users.create");
            Route::post("/store", [Admin\UserController::class, "store"])->name("users.store");
            Route::get("/edit/{id}", [Admin\UserController::class, "edit"])->name("users.edit");
            Route::post("/update/{id}", [Admin\UserController::class, "update"])->name("users.update");
            Route::post("/change-status", [Admin\UserController::class, "changeStatus"])->name("users.changeStatus");
            Route::delete('/destroy', [Admin\UserController::class, 'destroy'])->name('users.destroy');
            Route::get('/destroy-single/{id}', [Admin\UserController::class, 'deleteSingle'])->name('users.deleteSingle');
            Route::get('/export/{type}/{id?}', [Admin\UserController::class, 'export'])->name('users.export');

            // Ajax check
            Route::post('/check-mobile', [Admin\UserController::class, 'checkUserMobile'])->name('users.checkUserMobile');
            Route::post('/check-email', [Admin\UserController::class, 'checkUserEmail'])->name('users.checkUserEmail');
        });

        Route::prefix("category")->group(function(){
            Route::get("/", [Admin\CategoryController::class, "index"])->name("category.index");
            Route::get('/list', [Admin\CategoryController::class, 'getCategories'])->name('category.getCategories');
            Route::get("/create", [Admin\CategoryController::class, "create"])->name("category.create");
            Route::post("/store", [Admin\CategoryController::class, "store"])->name("category.store");
            Route::get("/edit/{id}", [Admin\CategoryController::class, "edit"])->name("category.edit");
            Route::post("/update/{id}", [Admin\CategoryController::class, "update"])->name("category.update");
            Route::post("/change-status", [Admin\CategoryController::class, "changeStatus"])->name("category.changeStatus");
            Route::delete('/destroy', [Admin\CategoryController::class, 'destroy'])->name('category.destroy');
            Route::get('/destroy-single/{id}', [Admin\CategoryController::class, 'deleteSingle'])->name('category.deleteSingle');
            Route::get('/export/{type}/{id?}', [Admin\CategoryController::class, 'export'])->name('category.export');

            // Ajax check
            Route::post('/check-name', [Admin\CategoryController::class, 'checkName'])->name('category.checkName');
        });

        Route::prefix("banner")->group(function(){
            Route::get("/", [Admin\BannerController::class, "index"])->name("banner.index");
            Route::get('/list', [Admin\BannerController::class, 'getBanners'])->name('banner.getBanners');
            Route::get("/create", [Admin\BannerController::class, "create"])->name("banner.create");
            Route::post("/store", [Admin\BannerController::class, "store"])->name("banner.store");
            Route::get("/edit/{id}", [Admin\BannerController::class, "edit"])->name("banner.edit");
            Route::post("/update/{id}", [Admin\BannerController::class, "update"])->name("banner.update");
            Route::post("/change-status", [Admin\BannerController::class, "changeStatus"])->name("banner.changeStatus");
            Route::delete('/destroy', [Admin\BannerController::class, 'destroy'])->name('banner.destroy');
            Route::get('/destroy-single/{id}', [Admin\BannerController::class, 'deleteSingle'])->name('banner.deleteSingle');
            Route::get('/export/{type}/{id?}', [Admin\BannerController::class, 'export'])->name('banner.export');

            // Ajax check
            Route::post('/check-name', [Admin\BannerController::class, 'checkName'])->name('banner.checkName');
        });

        Route::prefix("advertisment")->group(function(){
            Route::get("/", [Admin\AdvertismentController::class, "index"])->name("advertisment.index");
            Route::get('/list', [Admin\AdvertismentController::class, 'getAdvertisments'])->name('advertisment.getAdvertisments');
            Route::get("/create", [Admin\AdvertismentController::class, "create"])->name("advertisment.create");
            Route::post("/store", [Admin\AdvertismentController::class, "store"])->name("advertisment.store");
            Route::get("/edit/{id}", [Admin\AdvertismentController::class, "edit"])->name("advertisment.edit");
            Route::post("/update/{id}", [Admin\AdvertismentController::class, "update"])->name("advertisment.update");
            Route::post("/change-status", [Admin\AdvertismentController::class, "changeStatus"])->name("advertisment.changeStatus");
            Route::delete('/destroy', [Admin\AdvertismentController::class, 'destroy'])->name('advertisment.destroy');
            Route::get('/destroy-single/{id}', [Admin\AdvertismentController::class, 'deleteSingle'])->name('advertisment.deleteSingle');
            Route::get('/export/{type}/{id?}', [Admin\AdvertismentController::class, 'export'])->name('advertisment.export');

            // Ajax check
            Route::post('/check-name', [Admin\AdvertismentController::class, 'checkName'])->name('advertisment.checkName');
        });

        Route::prefix("tag")->group(function(){
            Route::get("/", [Admin\SubCategoryController::class, "index"])->name("subcategory.index");
            Route::get('/list', [Admin\SubCategoryController::class, 'getSubCategories'])->name('subcategory.getSubCategories');
            Route::get("/create", [Admin\SubCategoryController::class, "create"])->name("subcategory.create");
            Route::post("/store", [Admin\SubCategoryController::class, "store"])->name("subcategory.store");
            Route::get("/edit/{id}", [Admin\SubCategoryController::class, "edit"])->name("subcategory.edit");
            Route::post("/update/{id}", [Admin\SubCategoryController::class, "update"])->name("subcategory.update");
            Route::post("/change-status", [Admin\SubCategoryController::class, "changeStatus"])->name("subcategory.changeStatus");
            Route::delete('/destroy', [Admin\SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
            Route::get('/destroy-single/{id}', [Admin\SubCategoryController::class, 'deleteSingle'])->name('subcategory.deleteSingle');
            Route::get('/export/{type}/{id?}', [Admin\SubCategoryController::class, 'export'])->name('subcategory.export');

            // Ajax check
            Route::post('/check-name', [Admin\SubCategoryController::class, 'checkName'])->name('subcategory.checkName');
        });

        Route::prefix("state")->group(function(){
            Route::get("/", [Admin\StateController::class, "index"])->name("state.index");
            Route::get('/list', [Admin\StateController::class, 'getStates'])->name('state.getStates');
            Route::get("/create", [Admin\StateController::class, "create"])->name("state.create");
            Route::post("/store", [Admin\StateController::class, "store"])->name("state.store");
            Route::get("/edit/{id}", [Admin\StateController::class, "edit"])->name("state.edit");
            Route::post("/update/{id}", [Admin\StateController::class, "update"])->name("state.update");
            Route::post("/change-status", [Admin\StateController::class, "changeStatus"])->name("state.changeStatus");
            Route::delete('/destroy', [Admin\StateController::class, 'destroy'])->name('state.destroy');
            Route::get('/destroy-single/{id}', [Admin\StateController::class, 'deleteSingle'])->name('state.deleteSingle');
            Route::get('/export/{type}/{id?}', [Admin\StateController::class, 'export'])->name('state.export');

            // Ajax check
            Route::post('/check-name', [Admin\StateController::class, 'checkName'])->name('state.checkName');
        });

        Route::prefix("district")->group(function(){
            Route::get("/", [Admin\DistrictController::class, "index"])->name("district.index");
            Route::get('/list', [Admin\DistrictController::class, 'getDistricts'])->name('district.getDistricts');
            Route::get("/create", [Admin\DistrictController::class, "create"])->name("district.create");
            Route::post("/store", [Admin\DistrictController::class, "store"])->name("district.store");
            Route::get("/edit/{id}", [Admin\DistrictController::class, "edit"])->name("district.edit");
            Route::post("/update/{id}", [Admin\DistrictController::class, "update"])->name("district.update");
            Route::post("/change-status", [Admin\DistrictController::class, "changeStatus"])->name("district.changeStatus");
            Route::delete('/destroy', [Admin\DistrictController::class, 'destroy'])->name('district.destroy');
            Route::get('/destroy-single/{id}', [Admin\DistrictController::class, 'deleteSingle'])->name('district.deleteSingle');
            Route::get('/export/{type}/{id?}', [Admin\DistrictController::class, 'export'])->name('district.export');

            // Ajax check
            Route::post('/check-name', [Admin\DistrictController::class, 'checkName'])->name('district.checkName');

            // add in district in home page
            Route::post('/add-to-home', [Admin\DistrictController::class, 'addToHome'])->name('district.addToHome');
            Route::get('/list-home-districts', [Admin\DistrictController::class, 'listHomeDistricts'])->name('district.listHomeDistricts');
            Route::post('/update-order', [Admin\DistrictController::class, 'updateOrder'])->name('district.updateOrder');
        });

        Route::prefix("city")->group(function(){
            Route::get("/", [Admin\CityController::class, "index"])->name("city.index");
            Route::get('/list', [Admin\CityController::class, 'getCities'])->name('city.getCities');
            Route::get("/create", [Admin\CityController::class, "create"])->name("city.create");
            Route::post("/store", [Admin\CityController::class, "store"])->name("city.store");
            Route::get("/edit/{id}", [Admin\CityController::class, "edit"])->name("city.edit");
            Route::post("/update/{id}", [Admin\CityController::class, "update"])->name("city.update");
            Route::post("/change-status", [Admin\CityController::class, "changeStatus"])->name("city.changeStatus");
            Route::delete('/destroy', [Admin\CityController::class, 'destroy'])->name('city.destroy');
            Route::get('/destroy-single/{id}', [Admin\CityController::class, 'deleteSingle'])->name('city.deleteSingle');
            Route::get('/export/{type}/{id?}', [Admin\CityController::class, 'export'])->name('city.export');

            // Ajax check
            Route::post('/check-name', [Admin\CityController::class, 'checkName'])->name('city.checkName');
            Route::post('/get-districts-by-state', [Admin\CityController::class, 'getDistrictsByState'])->name('city.getDistrictsByState');
        });

        Route::prefix("role")->group(function(){
            Route::get("/", [Admin\RoleController::class, "index"])->name("role.index");
            Route::get('/list', [Admin\RoleController::class, 'getRoles'])->name('role.getRoles');
            Route::get("/create", [Admin\RoleController::class, "create"])->name("role.create");
            Route::post("/store", [Admin\RoleController::class, "store"])->name("role.store");
            Route::get("/edit/{id}", [Admin\RoleController::class, "edit"])->name("role.edit");
            Route::post("/update/{id}", [Admin\RoleController::class, "update"])->name("role.update");
            Route::post("/change-status", [Admin\RoleController::class, "changeStatus"])->name("role.changeStatus");
            Route::delete('/destroy', [Admin\RoleController::class, 'destroy'])->name('role.destroy');
            Route::get('/destroy-single/{id}', [Admin\RoleController::class, 'deleteSingle'])->name('role.deleteSingle');
            Route::get('/export/{type}/{id?}', [Admin\RoleController::class, 'export'])->name('role.export');
            Route::get('/permissions/{id}', [Admin\RoleController::class, 'permissions'])->name('role.permissions');
            Route::post("/update-permission", [Admin\RoleController::class, "updatePermissions"])->name("role.updatePermissions");

            // Ajax check
            Route::post('/check-name', [Admin\RoleController::class, 'checkName'])->name('role.checkName');
        });

        Route::prefix("vendors")->group(function(){
            Route::get("/", [Admin\UserController::class, "vendors"])->name("vendors.index");
            Route::get('/get-vendors', [Admin\UserController::class, 'getVendors'])->name('vendors.getVendors');
            Route::get("/create", [Admin\UserController::class, "createVendor"])->name("vendors.create");
            Route::post("/store", [Admin\UserController::class, "storeVendor"])->name("vendors.store");
            Route::get("/edit/{id}", [Admin\UserController::class, "editVendor"])->name("vendors.edit");
            Route::post("/update/{id}", [Admin\UserController::class, "updateVendor"])->name("vendors.update");
            Route::post("/change-status", [Admin\UserController::class, "changeStatus"])->name("vendors.changeStatus");
            Route::delete('/destroy', [Admin\UserController::class, 'destroyVendors'])->name('vendors.destroyVendors');
            Route::get('/destroy-single/{id}', [Admin\UserController::class, 'deleteSingleVendor'])->name('vendors.deleteSingleVendor');
            Route::get('/export/{type}/{id?}', [Admin\UserController::class, 'export'])->name('vendors.export');

            // Ajax check
            Route::post('/check-mobile', [Admin\UserController::class, 'checkUserMobile'])->name('vendors.checkUserMobile');
            Route::post('/check-email', [Admin\UserController::class, 'checkUserEmail'])->name('vendors.checkUserEmail');
            Route::post('/check-business-name', [Admin\UserController::class, 'checkBusinessName'])->name('vendors.checkBusinessName');
            Route::post('/get-states', [Admin\UserController::class, 'getDistrictsByState'])->name('vendors.getDistrictsByState');
            Route::post('/get-cities', [Admin\UserController::class, 'getCitiesByDistrict'])->name('vendors.getCitiesByDistrict');
            Route::post('/get-sub-categories', [Admin\UserController::class, 'getSubCategories'])->name('vendors.getSubCategories');
        });

        Route::prefix("cms")->group(function(){
            Route::get("/", [Admin\CmsController::class, "index"])->name("cms.index");
            Route::get("/edit/{id}", [Admin\CmsController::class, "edit"])->name("cms.edit");
            Route::post("/update/{id}", [Admin\CmsController::class, "update"])->name("cms.update");
        });
    });
});

Route::get('/', [Front\HomeController::class, "index"])->name('front.index');
Route::get('/about-us', [Front\HomeController::class, "aboutus"])->name('front.aboutus');
Route::get('/contact-us', [Front\HomeController::class, "contactus"])->name('front.contactus');
Route::get('/terms-and-conditions', [Front\HomeController::class, "termsAndConditions"])->name('front.termsAndConditions');
Route::get('/privacy-policy', [Front\HomeController::class, "privacyPolicy"])->name('front.privacyPolicy');
Route::get('/vendorlist', [Front\HomeController::class, "vendorlist"])->name('front.vendorlist');
Route::get('/vendorlist/{location}', [Front\HomeController::class, "vendorlistByLocation"])->name('front.vendorlist.location');
Route::get('/category/vendorlist/{category}', [Front\HomeController::class, "vendorlistByCategory"])->name('front.vendorlist.category');

Route::name('front.')->group(function(){
    // Route::get('/', [Front\HomeController::class, "index"])->name('index');
    Route::post("/login", [Front\HomeController::class, "authenticate"])->name("login");
    Route::get("/logout", [Front\HomeController::class, "destroy"])->name("logout");

    Route::post('/signup', [Front\HomeController::class, "signup"])->name('signup');

    Route::post('/update-category', [Front\ProfileController::class, 'updateCategory'])->name('updateCategory');

    Route::middleware('auth')->group(function(){
        Route::get('/profile', [Front\ProfileController::class, "index"])->name('profile');
        Route::post('/update-profile', [Front\ProfileController::class, "updateProfile"])->name('updateProfile');
        Route::post('/send-otp', [Front\ProfileController::class, "sendOtp"])->name('sendOtp');
        Route::post('/save-listing', [Front\ProfileController::class, "saveListing"])->name('saveListing');
    });
});


Route::get('/get-districts', [Front\HomeController::class, 'getDistricts'])->name('get.districts');
Route::get('/get-cities', [Front\HomeController::class, 'getCities'])->name('get.cities');

