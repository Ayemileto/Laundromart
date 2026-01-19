<div class="modal fade" id="show-modal">
    <div class="modal-dialog" id="show-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <!-- <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="confirm-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang("Site.no")?></button>
                <button type="button" id="confirm-modal-yes" class="btn"><?=lang("Site.yes")?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal -->


<script>
    function showModal(url, title='', size=null)
    {
        let valid_sizes = ['sm', 'md', 'lg', 'xl']
        
        if(!valid_sizes.includes(size))
        {
            size = 'lg';
        }

        $('#show-modal-dialog').addClass(`modal-${size}`);        
        $('#show-modal').modal('show');
    
        $.ajax({
            url: url,
            method: 'get',
            dataType: 'html',
            beforeSend: function()
            {
                $('#show-modal .modal-content').prepend(`
                            <div class="overlay d-flex justify-content-center align-items-center">
                                <i class="fas fa-2x fa-sync fa-spin"></i>
                            </div>`);
            
                $('#show-modal .modal-title').html(title);
                $('#show-modal .modal-body').html('Please Wait');
            },

            success: function(response)
            {
                $('#show-modal .overlay').remove();
                $('#show-modal .modal-body').html(response);
            }
        });
    }

/**
    trigger (string) = ID of the element that trigger this function.
    remove_trigger (bool) = true if we should hide the element from screen, false otherwise.

    replacement_trigger (string) = ID of another element/trigger we might want to show.
                    For example, if we activate a user, we might want to show another button to deactivate the user.

    remove_parent (string) =  HTML Tag of the parent element we want to remove.
                                For example, if we delete data from a table, 
                                we will remove the table row <tr> by passing 'tr' to this attribute

    btn_color = the color we want the confirm button to take.
 */
    function confirmModal(url, trigger, remove_trigger, replacement_trigger='', remove_parent ='', btn_color='btn-success', message='<?=lang('Site.are_you_sure')?>', title='<?=lang('Site.confirm_action')?>')
    {
        $('#confirm-modal').modal('show');
        $('#confirm-modal .modal-title').html(title);
        $('#confirm-modal .modal-body').html(message);
        $("#confirm-modal-yes").removeClass();
        $('#confirm-modal-yes').addClass('btn '+btn_color);

        $('#confirm-modal-yes').click(function(e){
            $.ajax({
                url: url,
                method: 'get',
                dataType: 'json',
                beforeSend: function()
                {
                    $('#confirm-modal .modal-content').prepend(`
                                <div class="overlay d-flex justify-content-center align-items-center">
                                    <i class="fas fa-2x fa-sync fa-spin"></i>
                                </div>`);
                },

                success: function(response)
                {
                    toastr.success(response.messages)
                    
                    if(remove_trigger)
                    {
                        $("#"+trigger).hide();
                    }

                    if(replacement_trigger != '')
                    {
                        $("#"+replacement_trigger).removeClass('hide');
                        $("#"+replacement_trigger).show();
                    }

                    if(remove_parent != '')
                    {
                        $("#"+trigger).parents(remove_parent).remove();
                    }
                    
                    if(response.refresh_page != undefined && response.refresh_page == true)
                    {
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    }
                },

                error:function(response)
                {
                    response = response.responseJSON;
                    let error_messages = response.messages;
                    if(typeof error_messages == "object")
                    {
                        for(var name in error_messages)
                        {
                            toastr.error(error_messages[name]);                    
                        }
                    }
                    else
                    {
                        toastr.error(error_messages);
                    }
                },

                complete:function()
                {
                    $('#confirm-modal .overlay').remove();
                    $('#confirm-modal').modal('hide');
                }
            });
            //Unbind event handler from button.
            $('#confirm-modal-yes').unbind();
        });

    }
</script>