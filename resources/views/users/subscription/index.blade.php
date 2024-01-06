
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-6">

    <a class="btn btn-outline-dark text-right" href="{{route('mypage')}}">マイページに戻る</a>

    @if(!$user->subscribed('main'))
        <div id="alert" role="alert" style="display:none">カードが認証できませんでした。</div>
        <form id="card_form" action="ajax/subscription/subscribe" method="POST">
        @csrf
        <table class="table mt-4 col-md-6">
            <tbody>
                <tr>
                    <th class="text-center">カード名義</th>
                    <td><input id="card_name" class="form-control" type="text" placeholder="山田 花子" name="card_name"></td>
                </tr>
                <tr>
                    <th class="text-center">カード番号</th>
                    <td><div id="card-element"></div></td>
                </tr>
            </tbody>
        </table>
        <button id="card_submit" class="btn btn btn-primary w-100"
        data-secret="{{ $intent->client_secret }}">有料会員になる</button>
        </form>
    @else
    <div id="alert" class="alert alert-warning my-2" role="alert" style="display:none">カードが認証できませんでした。</div>
    <form id="card_form" action="ajax/subscription/update_card" method="POST">
        @csrf
        <p>{{$user->defaultPaymentMethod()->billing_details->name}}</p>
        <p>**** **** **** {{$user->defaultPaymentMethod()->card->last4}}</p>
        <table class="table mt-4 col-md-6">
            <tbody>
                <tr>
                    <th class="text-center">カード名義</th>
                    <td><input id="card_name" class="form-control" type="text" placeholder="山田 花子" name="card_name"></td>
                </tr>
                <tr>
                    <th class="text-center">カード番号</th>
                    <td><div id="card-element"></div></td>
                </tr>
            </tbody>
        </table>
        <button id="card_submit" class="btn btn btn-primary w-100"
        data-secret="{{ $intent->client_secret }}">カードを変更する</button>
    </form>
    <a href="ajax/subscription/cancel" onClick="return confirm('本当に有料会員をやめてよろしいですか？');"><div class="btn btn btn-outline-danger w-100" >有料会員をやめる</div></a>
    @endif
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe = Stripe("{{$stripe_id}}");
    let elements = stripe.elements();
    let style = {
            base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
            color: "#aab7c4"
            }
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
        }
    };
    
    let card = elements.create('card', {style: style, hidePostalCode: true});
    card.mount('#card-element');
    const cardName = document.getElementById('card_name');
    const cardSubmit = document.getElementById('card_submit');
    const clientSecret = cardSubmit.dataset.secret;
    cardSubmit.addEventListener('click', async (e) => {
        e.preventDefault();
        const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
            payment_method: {
                card: card,
                billing_details: { name: cardName.value }
            }
        }
    );
    if (error) {
        console.log(error);
        document.getElementById('alert').style.display = "block";
    } else {
        stripePaymentHandler(setupIntent.payment_method);
    }
});
function stripePaymentHandler(payment_method) {
  let form = document.getElementById('card_form');
  let hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'payment_method');
  hiddenInput.setAttribute('value', payment_method);
  form.appendChild(hiddenInput);
  form.submit();
}


</script>
@endsection