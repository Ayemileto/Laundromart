<div class=container-fluid>
    <div class="row topspace">
    </div>
</div>
        <div class="container"><!--FIRST CONTAINER START-->     
            <div class="row d-flex justify-content-center"><!--FIRST ROW START-->
                <div class="col-sm-12 col-md-6 bg-light my-3 py-3">
                    <form action="" method="POST" id="reset_form">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $user_data["id"]; ?>">
                            <span class="text-danger error_field" id="email_error"></span> 
                            <input type="email" name="email" class="form-control" value="<?= $user_data["email"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <span class="text-danger error_field" id="password_error"></span> 
                            <input type="password" name="password" class="form-control" minlength ="8" maxlength="30" placeholder="Password" value="" required>
                        </div>
                        <div class="form-group">
                            <span class="text-danger error_field" id="password2_error"></span> 
                            <input type="password" name="password2" class="form-control" minlength ="8" maxlength="30" placeholder="Confirm Password" value="" required>
                        </div>
                        <div class="form-group">
                            <span class="text-danger error_field" id="error"></span>          
                            <span class="text-success error_field" id="success"></span>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="process(event);" id="submit_key">Update</button>
                    </form>
                </div>
            </div><!--FIRST ROW END-->
        </div><!--FIRST CONTAINER END-->

    <script>

        function process(e)
        {
            e.preventDefault();
            $(".error_field").html("");

            $.ajax({
                method:"post",
                url:"<?= base_url('updateuser'); ?>",
                dataType:"json",
                data:$("#reset_form").serialize(),

                beforeSend:function()
                {
                    $("#submit_key").html("Submitting  <i class='fas fa-spinner fa-spin'></i>");
                },

                success:function(data)
                {
                    $("#submit_key").html("Update");

                    if(data.status=="success")
                    {
                        $("#success").html("Success!!!.");
                        window.location.replace("<?= base_url() ?>");
                    }
                    else
                    {
                        $("#error").focus();
                        
                        if(typeof data.status == "object")
                        {
                            $("#error").html("<p>An Error Occured</p>");

                            for(var name in data.status)
                            {
                                var field_error_name=name+("_error");
                                $("#"+field_error_name).html(data.status[name]);
                            }
                        }
                        else
                        {
                            $("#error").html(data.status);
                        }                        
                    }
                }

            });
        }


    </script>