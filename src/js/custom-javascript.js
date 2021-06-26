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
                var expiredCard = $form.find('#cc-exp').val();
                var expSplit = expiredCard.split(" / ");
                var cardNumber = $('.cc-number').val().replace(/\s+/g, '');
                var cardType = $.payment.cardType($('.cc-number').val());
                $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
                $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
                $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
                $('.cc-brand').text(cardType);
                $('.validation').removeClass('text-danger text-success');
                $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
                var param_cc = {
                    amount: $form.find('#nominal').val(),
                    card_number: cardNumber,
                    card_exp_month: expSplit[0],
                    card_exp_year: expSplit[1],
                    card_cvn: $form.find('#cc-cvc').val(),
                    is_multiple_use: false,
                    should_authenticate: true,
                }
                console.log(param_cc);
                Xendit.card.createToken(param_cc, xenditResponseHandler);
                // Prevent the form from being submitted:
                return false;
            }
		});

        function xenditResponseHandler(err, creditCardToken) {
            console.log('err: ',err);
            console.log('cc token: ',creditCardToken);
            if (err) {
                // Show the errors on the form
                $('#error pre').text(err.message);
                $('#error').show();
                $form.find('.submit').prop('disabled', false); // Re-enable submission
        
                return;
            }
        
            if (creditCardToken.status === 'VERIFIED') {
                // Get the token ID:
                var token = creditCardToken.id;
        
                // Insert the token into the form so it gets submitted to the server:
                $form.append($('<input type="hidden" name="xenditToken" />').val(token));
        
                // Submit the form to your server:
                $form.get(0).submit();
            } else if (creditCardToken.status === 'IN_REVIEW') {
                window.open(creditCardToken.payer_authentication_url, 'sample-inline-frame');

                $('#three-ds-container').show();
                $('[name=token_id]').val(creditCardToken.id);
                $('[name=authentication_id]').val(creditCardToken.authentication_id);
                form.find('.submit').trigger('click');
            } else if (creditCardToken.status === 'FAILED') {
                $('#error pre').text(creditCardToken.failure_reason);
                $('#error').show();
                $form.find('.submit').prop('disabled', false); // Re-enable submission
            }
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
