<?php

use App\Http\Controllers\CancerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\order;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();



  });

  Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::get('user' ,'AuthController@user');
});


//User
Route::group([
    'prefix' => 'User'

    ],
    function() {

    Route::get('all' ,'AuthController@allUser');
    Route::get('One' ,'AuthController@getUser');
    Route::post('delete/{id}' ,'AuthController@destroy');
    Route::get('Find' ,'AuthController@findUser');


  }
    );
//Product
Route::group([
    'prefix' => 'product'

    ],
    function() {
    Route::post('create', 'ProductsController@create');
    Route::get('all', 'ProductsController@index');
    Route::post('edit/{id}', 'ProductsController@edit');
    Route::post('delete/{id}', 'ProductsController@destroy');
    Route::get('show/{id}', 'ProductsController@show');
    Route::post('Search', 'ProductsController@Search');
    Route::post('Add', 'ProductsController@addtoCart');
    Route::get('cat','ProductsController@getcategorie');


    }
);


//Patient
Route::group([
    'prefix' => 'patient'

    ],
    function() {
    Route::post('create', 'PatientController@create');
    Route::post('edit/{id}', 'PatientController@edit');
    Route::get('all', 'PatientController@index');
    Route::delete('delete/{id}', 'PatientController@destroy');
    Route::post('Search', 'PatientController@Search');
    Route::get('pat/{id}', 'PatientController@one');
    Route::get('cancer/{id}', 'PatientController@cancer');

    }
);

Route::group([
    'prefix' => 'cancer'

    ],
    function() {
    Route::get('all', 'CancerController@index');
    Route::post('patient', 'CancerController@cancer');

    }
);
//categories
  Route::group([
        'prefix' => 'categorie'
        ],
        function() {
        Route::post('add', 'CategoriesController@create');
        Route::get('all', 'CategoriesController@index');
        Route::put('edit/{id}', 'CategoriesController@edit');
        Route::post('delete/{id}', 'CategoriesController@destroy');
        Route::get('cat/{id}', 'CategoriesController@show');
        Route::post('cat', 'CategoriesController@category');
        Route::get('show/{id}', 'CategoriesController@one');




        }
    );

//order
    Route::group([
        'prefix' => 'orders'
        ],
        function() {
        Route::post('create', ' OrderController@store');
        Route::get('show', 'OrderController@index');
        Route::get('deliver', 'OrderController@deliverOrder');
        Route::post('update', 'OrderController@update');
        Route::get('deleted', 'OrderController@destroy');
        }
);
//subcat
Route::group([
    'prefix' => 'subcat'
    ],
    function() {
    Route::post('create', 'SubcatsController@create');
    Route::get('show', 'SubcatsController@index');
    Route::post('edit/{id}', 'SubcatsController@edit');
    Route::post('delete/{id}', 'SubcatsController@destroy');

    }
);
//auth

Route::group([
    'prefix' => 'auth'

], function() {
    Route::post('login' ,'AuthController@login');
    Route::post('signup', 'AuthController@signup');


   Route::group([
       'middelware' => 'auth:api'
   ], function() {

    Route::post('logout' ,'AuthController@logout');
    Route::get ('all','AuthController@allUser');


    //stripe
    Route::get('stripe', 'StripeController@stripe');
    Route::post('payment', 'StripeController@payStripe');
    //Cart
Route::group([
    'prefix' => 'Cart',

    ],

    function() {
Route::post('edit/{id}', 'CartsController@editCart');
Route::get('show','CartsController@show');
Route::post('delete/{id}', 'CartsController@destroy');
Route::post('add', 'CartsController@AddToCart');


    }
);
//Livreur
Route::group([
    'prefix' => 'livreur',

    ],

    function() {
Route::post('edit/{id}', 'LivreursController@edit');
Route::get('show','LivreursController@index');
Route::get('show/{id}','LivreursController@show');
Route::post('delete/{id}', 'LivreursController@destroy');
Route::post('create', 'LivreursController@create');


    }
);

Route::group([
    'prefix' => 'Carosel',

    ],

    function() {
Route::post('add', 'CarsolsController@create');
Route::get('all','CarsolsController@index');
Route::post('edit/{id}', 'CarsolsController@edit');
Route::post('delete/{id}', 'CarsolsController@destroy');
Route::get('show/{id}', 'CarsolsController@show');


    }

  );

   });




   Route::get('user/chekout' , function(){

       auth()->loginUsingId('id');

       $productuser = \App\User::where('id' , auth()->user()->id)->with('product')->first();

       echo '<h1>'.$productuser->name.'</h1>';

       foreach ($productuser->product as $product){


           echo $product->name .'|'.$product->price.'<br>';
       }

   });

   Route::get('product/{id}' , function($id){


    $product= \App\Product::where('id' ,$id)->with('user')->first();

    dd($product->toArray());




   });

   Route::get('categories/sub/{id}' , function($id){

    $categorieSou = \App\Categories::where('id', $id)->with('Subcats')->first();


    dd($categorieSou->toArray());

    });


    Route::get('allSub', function(){

       $sub = \App\Subcat::get();

       foreach ($sub as $sub ){

        echo $sub->name.'<br>';
       }

    });



});
