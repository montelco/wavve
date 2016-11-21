@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Your Payment Method</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}
                        <span class="payment-errors"></span>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Card Number</label>

                            <div class="col-md-6">
                                <input type="text" size="20" data-stripe="number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Expiration</label>

                            <div class="col-md-6">
                                <label>
                                    <span>(MM/YY)</span>
                                    <input type="text" size="2" data-stripe="exp_month">
                                </label>
                                <span> / </span>
                                <input type="text" size="2" data-stripe="exp_year">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">CVV/CVC</label>

                            <div class="col-md-6">
                                <input type="text" size="4" data-stripe="cvc">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Billing Zip Code</label>

                            <div class="col-md-6">
                                <input type="text" size="6" data-stripe="address_zip">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-check-circle"></i>Register
                                </button>
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
