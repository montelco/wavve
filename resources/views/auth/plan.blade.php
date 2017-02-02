@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Choose Your Plan</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/plan/monthly-1">
                        {!! csrf_field() !!}
                        <span class="payment-errors"></span>
                        <div class="form-group">
                            <div class="col-lg-12 col-lg-offset-4">
                                <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="pk_test_JTKAeFPFAOS9oJs9pHlwmG8F"
                                    data-amount="15000"
                                    data-name="Wavvve by ATMT"
                                    data-currency="USD"
                                    data-description="Monthly Subscription (w Three Beacons)"
                                    data-image="https://wavvve.io/favicons/favicon-96x96.png"
                                    data-locale="auto"
                                    data-label="Get Monthly (150/mo)"
                                    data-zip-code="true">
                                </script>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" role="form" method="POST" action="/plan/yearly-1">
                        {!! csrf_field() !!}
                        <span class="payment-errors"></span>
                        <div class="form-group">
                            <div class="col-lg-12 col-lg-offset-4">
                                <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="pk_test_JTKAeFPFAOS9oJs9pHlwmG8F"
                                    data-amount="150000"
                                    data-name="Wavvve by ATMT"
                                    data-currency="USD"
                                    data-description="Yearly Subscription"
                                    data-image="https://wavvve.io/favicons/favicon-96x96.png"
                                    data-locale="auto"
                                    data-label="Get Yearly (1500/yr)"
                                    data-zip-code="true">
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  Stripe.setPublishableKey('pk_test_JTKAeFPFAOS9oJs9pHlwmG8F');
</script>
@endsection
