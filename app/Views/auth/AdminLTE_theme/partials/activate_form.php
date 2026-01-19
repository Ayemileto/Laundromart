<div class=container-fluid>
    <div class="row topspace">
    </div>
</div>

        <div class="container"><!--FIRST CONTAINER START-->     
            <div class="row d-flex justify-content-center"><!--FIRST ROW START-->
                <div class="col-sm-12 col-md-6 bg-light my-3 py-3">
                    <span class="text-danger"><p>If You Can't Verify You Account After Resending Link, Kindly <a href="#contact">Contact Us</a>.</p></span>          
                    <p>
                        <span class="text-danger error_field" id="error"></span>          
                        <span class="text-success error_field" id="success"></span>
                    </p>
                    <form action="" method="POST" id="activate_form">
                        <div class="form-group">
                            <span class="text-danger error_field" id="email_error"></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="" required>
                        </div>
                        <input type="hidden" name="submit" value="1">
                        <button type="submit" class="btn btn-primary" onclick="process(event);" id="submit_key">Send Activation Email</button>
                    </form>
                </div>
            </div><!--FIRST ROW END-->
        </div><!--FIRST CONTAINER END-->
<div style="padding:30px;"></div>
    <script>

        function process(e)
        {
            e.preventDefault();
            $(".error_field").html("");

            $.ajax({

                method:"post",
                url:"<?= base_url('activateprofile'); ?>",
                dataType:"json",
                data:$("#activate_form").serialize(),

                beforeSend:function()
                {
                    $("#submit_key").html("Submitting  <i class='fas fa-spinner fa-spin'></i>");
                },

                success:function(data)
                {
                    $("#submit_key").html("Submit");

                    if(data.result=="success")
                    {
                        $("#success").html("Success!!! Activation Email Has Been Sent.");
                    }
                    else
                    {
                        $("#error").focus();
                        
                        if(typeof data.result == "object")
                        {
                            $("#error").html("<p>There Seems To Be Some Errors In Your Form. Check them Below</p>");

                            for(var name in data.result)
                            {
                                var field_error_name=name+("_error");
                                $("#"+field_error_name).html(data.result[name]);
                            }
                        }
                        else
                        {
                            $("#error").html(data.result);
                        }                        
                    }
                }

            });
        }


    </script>