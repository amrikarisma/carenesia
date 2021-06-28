// Add your JS customizations here
jQuery(function($) {
    $('.home-slider, .home-planner').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1,
                height:400
            }
        }
    });
    $('.testimoni-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        dots:true,
        responsive:{
            0:{
                items:1
            },
            768: {
                item:2
            },
            1200: {
                item:3
            },
        }
    });
    $(function() {

		$('[data-numeric]').payment('restrictNumeric');
		$('.cc-number').payment('formatCardNumber');
		$('.cc-exp').payment('formatCardExpiry');
		$('.cc-cvc').payment('formatCardCVC');
		$.fn.toggleInputError = function(erred) {
            console.log(erred);
			this.parent('.form-group').toggleClass('has-error', erred);
			return this;
		};
        var $form = $('#payment-form');
		$form.submit(function(e) {
            if($('#payment_method').val() == 'credit_card' && $('[name=token_id]').val() == '') {
                e.preventDefault();
                hideResults();

                var cardType = $.payment.cardType($('.cc-number').val());
                $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
                $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
                $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
                $('.cc-brand').text(cardType);
                $('.validation').removeClass('text-danger text-success');
                $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
                // Request a token from Xendit:
                var tokenData = getTokenData();

                Xendit.card.createToken(tokenData, xenditResponseHandler);
                // Prevent the form from being submitted:
                return false;
            }
		});

        function xenditResponseHandler(err, creditCardToken) {
            console.log('err: ',err);
            console.log('cc token: ',creditCardToken);
            if (err) {
                return displayError(err);
            }
            if (creditCardToken.status === 'APPROVED' || creditCardToken.status === 'VERIFIED') {
                displaySuccess(creditCardToken);
            } else if (creditCardToken.status === 'IN_REVIEW') {
                window.open(creditCardToken.payer_authentication_url, 'sample-inline-frame');
                $('body').css('position', 'relative');
                $('.modal-donation').addClass('d-none');
                $('.overlay').show();
                $('#three-ds-container').show();
            } else if (creditCardToken.status === 'FRAUD') {
                displayError(creditCardToken);
            } else if (creditCardToken.status === 'FAILED') {
                displayError(creditCardToken);
            }
        }
        function displayError (err) {
            $('.modal-donation').removeClass('d-none');
            $('#three-ds-container').hide();
            $('.overlay').hide();
            $('#error .result').text(JSON.stringify(err, null, 4));
            $('#error').show();

            var requestData = {};
            $.extend(requestData, getTokenData());
            $('#error .request-data').text(JSON.stringify(requestData, null, 4));

        };

        function displaySuccess (creditCardToken) {
            $('.modal-donation').removeClass('d-none');
            $('.modal-donation').show();
            $('#three-ds-container').hide();
            $('.overlay').hide();
            // $('[name=token_id]').val(creditCardToken.id);
            // $('[name=authentication_id]').val(creditCardToken.authentication_id);
            // $('.modal-donation').find('form').trigger('reset');
            // $('#content_donation').html(messageSuccess(creditCardToken));
            // $('.modal-donation').show();

            var requestData = {};
            $.extend(requestData, getTokenData());
            $('#success .request-data').text(JSON.stringify(requestData, null, 4));
            return createCharge(creditCardToken);

        }

        function getTokenData () {
            var expiredCard = $form.find('#cc-exp').val();
            var expSplit = expiredCard.split(" / ");
            var cardNumber = $('.cc-number').val().replace(/\s+/g, '');
            return {
                amount: $form.find('#nominal').val(),
                card_number: cardNumber,
                card_exp_month: expSplit[0],
                card_exp_year: expSplit[1],
                card_cvn: $form.find('#cc-cvc').val(),
                is_multiple_use: $form.find('#bundle-authentication').prop('checked') ? true : false,
                should_authenticate: $form.find('#skip-authentication').prop('checked') ? false : true,
                currency: $form.find('#currency').val(),
                on_behalf_of: $form.find('#on-behalf-of').val(),
                billing_details: $form.find('#should-send-billing-details').prop('checked') ? getBillingDetails() : undefined,
                customer: $form.find('#should-send-customer-details').prop('checked') ? getCustomerDetails() : undefined,
            };
        }
        function hideResults() {
            $('#success').hide();
            $('#error').hide();
        }

        function getBillingDetails () {
            return JSON.parse($form.find('#billing-details').val());
        }

        function getCustomerDetails () {
            return JSON.parse($form.find('#customer-details').val());
        }

        function createCharge(d) {
            var formData = {
                'action': 'create_charge',
                'nominal': $form.find('#nominal').val(),
                'authentication_id': d.authentication_id,
                'token_id': d.id,
            };

            console.log(formData);

            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: ajax_carenesia.ajaxurl,
                data: formData,
                success: function(data){
                    console.log(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log("Status: ", textStatus);
                    console.log("Error: ", errorThrown); 
                }    
            });
        }
        
	});
    $(function () {
       $('#payment_method').on('change', function () {
           console.log($(this).val());
          if($(this).val() == 'bank') {
            $('#wrap_va_banks').css('display','block');
            $('#credit_card_form').css('display','none');
            $('.modal-donation ').find('.modal-dialog').removeClass('credit-card-form-active');
            $('.modal-donation ').find('#section_form_donatur').removeClass('col-md-6');
            $('.modal-donation ').find('#section_form_donatur').addClass('col-md-12');
          } else {
            $('#wrap_va_banks').css('display','none');
            $('#credit_card_form').css('display','block');
            $('.modal-donation ').find('.modal-dialog').addClass('credit-card-form-active');
            $('.modal-donation ').find('#section_form_donatur').removeClass('col-md-12');
            $('.modal-donation ').find('#section_form_donatur').addClass('col-md-6');
          }
       });
    });
});
