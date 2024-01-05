<?php

namespace App\Http\Controllers\User\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubscriptionController extends Controller
{

    public function index(){
        $stripe_id = env('STRIPE_KEY');
        $user = Auth::user();
        $intent = Auth::user()->createSetupIntent();

        return view('users.subscription.index',compact('intent','stripe_id','user'));
       }

    //サブスクプラン
    public function subscribe(Request $request) {
        if(!$request->user()->subscribed('main')){   
            $request->user()->newSubscription(
                'main',
                env('STRIPE_BASIC_ID')
            )->create($request->payment_method);
            return redirect()->route('mypage')->with('message', '有料会員に登録されました');
        }
    }


    // キャンセル
    public function cancel(Request $request) {
        $user = Auth::user();
        if($user->subscribed('main')){
            $request->user()
                ->subscription('main')
                ->delete();
            return redirect()->route('mypage')->with('message', '有料会員を終了しました');
        }else{
            return redirect()->route('mypage');
        }
    }


    // カード情報を変更する
    public function update_card(Request $request) {

        $payment_method = $request->payment_method;
        $request->user()
            ->updateDefaultPaymentMethod($payment_method);
            return redirect()->route('mypage');
    }

       
}
