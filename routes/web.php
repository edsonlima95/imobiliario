<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Web\FilterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'web.'], function () {

    /**
     * Rota da home do site.
     */
    Route::get('/', [WebController::class, 'home'])->name('home');
    Route::get('/destaque', [WebController::class, 'spotlight'])->name('spotlight');
    Route::get('/comprar', [WebController::class, 'buy'])->name('buy');
    Route::get('/comprar/quero-comprar/{slug}', [WebController::class, 'buyProperty'])->name('buyProperty');
    Route::get('/alugar', [WebController::class, 'rent'])->name('rent');
    Route::get('/alugar/quero-alugar/{slug}', [WebController::class, 'rentProperty'])->name('rentProperty');
    Route::get('/categoria/{type?}',[WebController::class,'propertyCategory'])->name('propertyCategory');
    Route::get('/contato', [WebController::class, 'contact'])->name('contact');
    Route::match(['post','get'],'/filter',[WebController::class, 'filter'])->name('filter');
    Route::get('/experience/{slug?}',[WebController::class, 'experience'])->name('experience');
    Route::post('/enviar-email',[WebController::class, 'sendEmail'])->name('sendEmail');

});

Route::group(['prefix'=>'component','as'=>'component.'], function (){

    Route::post('main-filter/search',[FilterController::class,'search'])->name('main-filter.search');
    Route::post('main-filter/category', [FilterController::class,'category'])->name('main-filter.category');
    Route::post('main-filter/type', [FilterController::class,'type'])->name('main-filter.type');
    Route::post('main-filter/neighborhood', [FilterController::class,'neighborhood'])->name('main-filter.neighborhood');
    Route::post('main-filter/bedrooms', [FilterController::class,'bedrooms'])->name('main-filter.bedrooms');
    Route::post('main-filter/suites', [FilterController::class,'suites'])->name('main-filter.suites');
    Route::post('main-filter/bathrooms', [FilterController::class,'bathrooms'])->name('main-filter.bathrooms');
    Route::post('main-filter/garage', [FilterController::class,'garage'])->name('main-filter.garage');
    Route::post('main-filter/price-base', [FilterController::class,'priceBase'])->name('main-filter.priceBase');
    Route::post('main-filter/price-limit', [FilterController::class,'priceLimit'])->name('main-filter.priceLimit');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    /**
     * ROTAS DE LOGIN
     */
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.create');
    Route::post('/entrar', [AuthController::class, 'login'])->name('login.signin');
    Route::get('/sair', [AuthController::class, 'logout'])->name('login.logout');

    /**
     * GRUPO DE ROTAS PROTEGIDAS
     */
    Route::group(['middleware' => ['auth']], function () {

        //ROTA DA HOME
        Route::get('/', [AuthController::class, 'home'])->name('home');

        //USUATIOS
        Route::get('users/team', [UserController::class, 'team'])->name('users.team');
        Route::resource('users', UserController::class);

        //EMPRESAS
        Route::resource('/companies', CompanyController::class);

        //CONTRATOS
        Route::post('/contracts/get-data-owner', [ContractController::class, 'getDataOwner'])->name('contracts.getDataOwner');
        Route::post('/contracts/get-data-acquirer', [ContractController::class, 'getDataAcquirer'])->name('contracts.getDataAcquirer');
        Route::post('/contracts/get-data-property', [ContractController::class, 'getDataProperty'])->name('contracts.getDataProperty');
        Route::get('/contracts/pdf/{id}', [ContractController::class, 'contractPdf'])->name('contracts.pdf');
        Route::resource('/contracts', ContractController::class);

        //IMOVEIS
        Route::post('properties/image-set-cover', [PropertyController::class, 'imageSetCover'])->name('properties.imageSetCover');
        Route::delete('properties/image-remove', [PropertyController::class, 'imageRemove'])->name('properties.imageRemove');
        Route::resource('/properties', PropertyController::class);
    });
});

