
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
            Anything you want
            </div>
            <!-- Default to the left -->
            <?=getSetting('footer_text')?>
        </footer>
        </div>
        <!-- ./wrapper -->

        <script src="<?=assetUrl("plugins/popper/popper.min.js")?>"></script>
        <script>
            $(function (){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

        <!-- AdminLTE App -->
        <script src="<?=assetUrl("backend/AdminLTE_theme/js/adminlte.min.js")?>"></script>
    

        <?=view('includes/js/footer')?>
    </body>
</html>