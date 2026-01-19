<?=view("includes/css/calendar")?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <span class="text-white p-1 text-uppercase" style="background-color:#0073b7;width:100px;"><?=lang('Site.pickups')?></span>
                    <span class="text-white p-1 text-uppercase" style="background-color:#00a65a;width:100px;"><?=lang('Site.deliveries')?></span>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                    <div id="details_div">

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<?=view("includes/js/calendar")?>

<!-- Page specific script -->
<script>
    showCalendar("<?=fullUrl(route_to('user_route_fetch_calendar_items'))?>");
</script>