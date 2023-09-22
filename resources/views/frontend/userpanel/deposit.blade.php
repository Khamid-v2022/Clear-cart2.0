@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title">{{ __('frontend/user.deposit') }}</h3>

            <div class="card">
                <div class="card-header">{{ __('frontend/user.payment_methods') }}</div>

                <div class="card-body">
                    <!-- <a href="{{ route('deposit-btc') }}" class="btn btn-warning btn-cashin">{{ __('frontend/user.cashin_btc_button') }}</a> -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payBTC_modal">
                        {{ __('frontend/user.cashin_btc_button') }}
                    </button>
                </div>
            </div>

            <!-- <div class="card mt-15">
                <div class="card-header">{{ __('frontend/user.coupon_redeem.title') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('redeem-coupon') }}">
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-12">
                            <label for="coupon_redeem_code" class="text-md-right">{{ __('frontend/user.coupon_redeem.code') }}</label>
                        <input id="coupon_redeem_code" type="text" class="form-control{{ $errors->has('coupon_redeem_code') ? ' is-invalid' : '' }}" name="coupon_redeem_code" value="{{ old('coupon_redeem_code') }}" required autofocus>

                                @if ($errors->has('coupon_redeem_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('coupon_redeem_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('frontend/user.coupon_redeem.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="payBTC_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  id="pay_form">
                <div class="modal-body">
                    <input type="number" class="form-control" min="0" id="pay_amount" placeholder="pay in cent" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit_btn" class="btn btn-primary">Pay</button>
                    <!-- <a href="{{ route('deposit-btc') }}" class="btn btn-primary">{{ __('frontend/user.cashin_btc_button') }}</a> -->
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@section('page_scripts')
<script type="text/javascript">
	$(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $("#pay_form").on("submit", function(e){
            e.preventDefault();

            const amount = parseInt($("#pay_amount").val());
            if(amount < 500) {
                alert("The minimum amount is 500(5 EURO).");
                return;
            }

            $("#submit_btn").attr("disabled", true);

            let url = "{{route('deposit-btc')}}";
            $.post(url, {amount}, function(resp){
                console.log(resp);
                if(resp.code && resp.code == 201){
                    alert("You have already paid but there are transactions that have not been processed. Please pay more after your payment has already been processed.");
                    $("#payBTC_modal").modal('hide');
                    return;
                }
                if(resp.checkoutLink){
                    // close the modal
                    $("#payBTC_modal").modal('hide');

                    let params = `width=480,height=760,left=100,top=100`;
                    window.open(resp.checkoutLink, 'mywindow', params).focus();

                    alert("It may take up to 1 hour for your payment to be processed.");
                }
                    
            })
        })
  	});
</script>
@endsection
