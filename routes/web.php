<?php
use Illuminate\Http\Request;
use Stripe\Stripe as stripe;
use Stripe\Charge as charge;
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
Route::get('/checkout/stripe', 'StripePaymentController@stripe')->name('stripe');
Route::post('/checkout/stripe', 'StripePaymentController@stripePayment')->name('stripepayment');
//Route::post('/charge',function (Request $request){
//   dd($request->all());
//    try {
//        $stripe = stripe::make('test_api_key');
//        $charge = stripe::charges()->create([
//            'amount' => 200,
//            'currency' => 'GBP',
//            'source' => $request->stripeToken,
//            'description' =>'description goes here',
//            'receipt_email' =>$request->email,
//            'metadata' =>[
//                'data1' => 'metadata1',
//                'data2' => 'metadata2',
//                'data3' => 'metadata3',
//            ],
//        ]);
//        return back()->with('success_message','Thank you! Your payment had been accepted.');
//    }catch (\Exception $e){
//        return back()->withErrors('Error! '. $e->getMessage());
//    }
//});