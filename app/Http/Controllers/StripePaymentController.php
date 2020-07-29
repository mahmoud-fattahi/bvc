<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\Util\Str;
use Session;
use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePayment(Request $request)
    {
//        Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe::setApiKey('sk_test_51H59NGHhESNYxJOFxOqBVsyl72sG1xt8Nbsu3Q6FrlWpsMsijPwTNaeJDQIw6lWXZdzErFYJp3IftJl3ieh4hRQN00xYkZp6VJ');
//        Stripe::setApiVersion("2020-03-02");
        $cart = cart()->getCart();
//        try {
//            Stripe::setApiKey(env('STRIPE_SECRET'));
            Charge::create([
//                'amount' => $request->get('total'),
                'amount' => $cart->base_grand_total,
                'currency' => $cart->base_currency_code,
                'description' => 'Product info',
                'source' => $request->get('stripeToken'),
                'receipt_email' => $request->get('email'),
                'payment_method_types' => ['card'],
                'metadata' => [
                    'order_id' => 1234,
                ]
            ], [
                "idempotency_key" => "0D0sPWN8tLz5fCLv",]);
            //save your customer oreder to database here
            return back()->with('success_message', 'Thank you! Your payment had been accepted.');
//        }catch (\Exception $e){
//            return back()->withErrors('Error! '. $e->getMessage());
//        }
    }
//    public function stripePost(Request $request)
//    {
//        Stripe::setApiKey(env('STRIPE_SECRET'));
//
//        Charge::create([
//            'amount' => $request->get('total'),
//            'currency' => 'gbp',
//            'description' => 'Product info',
//            'source' => $request->get('stripeToken'),
//            'receipt_email' => $request->get('email'),
//            'customer' => '20',
//            'payment_method' => '1',
//            'off_session' => true,
//            'confirm' => true,
//             'metadata' =>[
//                 'order_id' => 1234,
//             ]
//        ]);
        //dd($request->all());
//        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
//        Stripe\Charge::create ([
//            "amount" => 100 * 100,
//            "currency" => "gbp",
//            "source" => $request->stripeToken,
//            "description" => "Test payment from bigvapeclub.com."
//        ]);
//
//        Session::flash('success', 'Payment successful!');
//
//        return back();


//        try {
//        $stripe = Stripe::make('test_api_key');
////            $stripe = new Stripe\StripeClient(
////                'sk_test_4eC39HqLyjWDarjtT1zdp7dc'
////            );
//            $stripe->charges->create([
//                'amount' => 2000,
//                'currency' => 'gbp',
//                'source' => $request->stripeToken,
//                'description' => 'My First Test Charge (created for API docs)',
//            ]);
//            $charge = Stripe::charges()->create([
//                'amount' => 20,
//                'currency' => 'USD',
//                'source' => $request->stripeToken,
//                'description' =>'description goes here',
//                'receipt_email' =>$request->email,
//                'metadata' =>[
//                    'data1' => 'metadata1',
//                    'data2' => 'metadata2',
//                    'data3' => 'metadata3',
//                ],
//            ]);
//            return back()->with('success_message','Thank you! Your payment had been accepted.');
//        }catch (\Exception $e){
//            return back()->withErrors('Error! '. $e->getMessage());
//        }
//    }
}

