
<!-- jquery-validation -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script>
    function submitForm(formId)
    {
        $("#"+formId).validate({
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('div').append(error);
            },
            highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },

            submitHandler: function (form){
                let submit_val = $(form).find("#form-submit").html();
                $(form).ajaxSubmit({
                    dataType: "json",

                    beforeSend:function()
                    {
                        $(form).find(".error_field").html("");
                        $(form).find("#form-submit").html("Please Wait ...");
                    },

                    success:function(data)
                    {
                        $(form).find("#success").html(data.messages);
                        toastr.success(data.messages);

                        // IF A JAVASCRIPT CALLBACK FUNCTION IS ADDED TO THE RESPONSE
                        if(data.js_callback_function != undefined)
                        { 
                            // IF NO CALLBACK FUNCTION PARAMETERS ARE ADDED TO THE RESPONSE, SET AN EMPTY PARAMETER
                            if(data.js_callback_function_params == undefined)
                            {
                                data.js_callback_function_params = '';
                            }
                            // CALL THE FUNCTION, AND PASS THE PARAMETERS
                            window[data.js_callback_function](data.js_callback_function_params);
                        }

                        // IF THE RESPONSE HAS A redirect_to attribute, redirect to the set page
                        if(data.redirect_to != undefined)
                        {
                            setTimeout(function() {
                                window.location.replace(data.redirect_to);
                            }, 1000);
                        }

                        // THIS IS USED TO RESET THE FIGURE NEXT TO CART ICON WHEN ADDING OR REMOVING PRODUCTS FROM CART.
                        if(data.cart_item_count != undefined && !isNaN(data.cart_item_count))
                        {
                            $('.cart-item-count').html(data.cart_item_count);
                            $('#show-modal').modal('hide');
                        }
                    },

                    error:function(data)
                    {
                        data = data.responseJSON;
                        let error_messages = data.messages;

                        for(var name in error_messages)
                        {
                            var field_error_name=name+("_error");
                            $(form).find("#"+field_error_name).html(error_messages[name]);
                            toastr.error(error_messages[name]);
                        }
                    },

                    complete: function()
                    {
                        $(form).find("#form-submit").html(submit_val);
                    }
                })
            }
        });
    }
</script>