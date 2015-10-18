(function ($) {
    'use strict';

    var ERRORS_CLASS    = 'payment-errors',
        ERRORS_SELECTOR = '.' + ERRORS_CLASS;

    window.StripeBundle = {
        EVENTS: {
            FORMAT_ERROR_MSG: 'cm_stripe:formatError'
        }
    };

    // -----------------------------------------------------------------------------------------------------------------
    // StriptForm
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * @param form
     * @constructor
     */
    function StripeForm(form) {
        this.$form = $(form);

        /**
         * @type {jQuery}
         */
        this.$errors = null;

        this.$form.submit($.proxy(this.hijackFormSubmission, this));

        this.setupErrors();
    }


    /**
     * Adds the errors element if not already found
     */
    StripeForm.prototype.setupErrors = function () {
        this.$errors = $(ERRORS_SELECTOR, this.$form);
        if (0 === this.$errors.length) {
            this.$errors = $('<div class="' + ERRORS_CLASS + '"></div>');
            this.$form.prepend(this.$errors);
        }
    };


    /**
     * Event handler for intercepting the form submission & redirecting it to the Stripe card token creation script
     * @param event
     * @return {boolean}
     */
    StripeForm.prototype.hijackFormSubmission = function (event) {
        var $form = this.$form;

        // Disable the submit button to prevent repeated clicks
        $form.find('button').prop('disabled', true);

        Stripe.card.createToken($form, $.proxy(this.stripeResponseHandler, this));

        // Prevent the form from submitting with the default action
        return false;
    };


    /**
     * Processes the Stripe card token creation response and assigns the token value to the hidden field
     *
     * @param {int}                                              status
     * @param {{}}                                               response
     * @param {{}}                                               response.error
     * @param {'invalid_request_error'|'api_error'|'card_error'} response.error.type
     * @param {string}                                           response.error.message
     * @param {string}                                           response.error.code
     * @param {string}                                           response.error.param
     * @param {string}                                           response.id
     * @param {{}}                                               response.card
     * @param {timestamp}                                        response.created
     * @param {string}                                           response.currency
     * @param {bool}                                             response.livemode
     * @param {'token'}                                          response.object
     * @param {bool}                                             response.used
     */
    StripeForm.prototype.stripeResponseHandler = function (status, response) {
        var errorMessage,
            errorDetails,
            sanitizer;
        if (response.error) {
            errorMessage = response.error.message;

            // Sanitise the error message to remove HTML tags
            sanitizer = $('<div></div>');
            sanitizer.text(errorMessage);
            errorMessage = sanitizer.html();


            /**
             * Event: StripeBundle.EVENTS.FORMAT_ERROR_MSG
             * Object: {{errorMessage: string}}
             */
            errorDetails = {errorMessage: errorMessage};
            this.$form.trigger(StripeBundle.EVENTS.FORMAT_ERROR_MSG, errorDetails);
            errorMessage = errorDetails.errorMessage;

            // Show the errors on the form
            this.$form.find('.payment-errors').html(errorMessage);
            this.$form.find('button').prop('disabled', false);
        } else {
            // response contains id and card, which contains additional card details
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            $('.stripe-token', this.$form).val(token);
            // and submit
            this.$form.get(0).submit();
        }
    };

    $(function ($) {
        $('form.stripe-form').each(function (i, form) {
            $(form).data('stripeForm', new StripeForm(form));
        });
    });
})(jQuery);