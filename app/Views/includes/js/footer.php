        <!-- Toastr -->
        <script src="<?=assetUrl("plugins/toastr/toastr.min.js")?>"></script>

        <script>
            function formatMoney(amount)
            {
                return '<?=currency()?> '+parseFloat(amount).toFixed(2).toLocaleString();
            }
        </script>

    <?php
        if(!empty(session('alert-error'))):
    ?>
        <script>
            $(function (){
                toastr.error('<?=session('alert-error')?>');
            });
        </script>
    <?php
        endif;

        if(!empty(session('alert-success'))):
    ?>
        <script>
            $(function (){
                toastr.success('<?=session('alert-success')?>');
            });
        </script>
    <?php
        endif;
    ?>