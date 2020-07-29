<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid #cccccc;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
        #card-errors{
            color: #fa755a;
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div class="container mt-4 mb-4" id="app">
    <div class="row">
        <h3>Payment Form</h3>
        @if(Session::get('success_message'))
            <div class="alert alert-success">{{Session::get('success_message')}}</div>
            @endif
    </div>
    <form action="{{route('stripepayment')}}" method="post" id="payment-form">
{{--    <form action="{{('/stripe')}}" method="post" id="payment-form">--}}
        @csrf
{{--        {{csrf_field()}}--}}
        <div class="form-group">
            <label>Email</label>
            <input type="text" id="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" id="name" name="name" class="form-control" >
        </div>
        <div class="form-group">
            <label>State</label>
            <input type="text" id="State" name="State" class="form-control">
        </div>
        <div class="form-group">
            <label>city</label>
            <input type="text" id="city" name="city" class="form-control">
        </div>
        <div class="form-group">
            <label>country</label>
            <input type="text" id="country" name="country" class="form-control">
        </div>
        <div class="form-group">
            <label>Total</label>
            <input type="text" id="total" name="total" class="form-control">
        </div>
        <div class="form-group">
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
<script>
    // Create a Stripe client.
    var stripe = Stripe('{{ config('services.stripe.key') }}');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
// var options = {
//     name:document.getElementById('name'),value,
//     address_city:document.getElementById('city').value,
//     address_country:document.getElementById('country').value,
//     address_state:document.getElementById('state').value
// }
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        // alert(token.id)
         form.submit();
    }
</script>
</body>
</html>