<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><?=lang('Site.sales')?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold" id="this-year-sales"></span>
                                <span><?=lang('Site.sales_this_year')?></span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success" id="percent-change-since-last-month">
                                </span>
                                <span class="text-muted"><?=lang('Site.since_last_month')?></span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>
                        <div class="">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> <?=lang('Site.completed_orders')?>
                        </span>

                        <span>
                            <i class="fas fa-square text-purple"></i> <?=lang('Site.new_subscriptions')?>
                        </span>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="col-lg-6">
                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title"><?=lang('Site.sales_by_products')?> (30d)</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-6">
                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title"><?=lang('Site.subscritions_by_plans')?> (30d)</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="subscription-by-plans"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>






        </div>
        <!-- /.row -->
    </div>
</div>


<?=view("includes/js/chartjs")?>

<script>
    $(function () {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode      = 'index'
        var intersect = true

        $.ajax({
            url: "<?=base_url().route_to("admin_route_sales_stats")?>",
            method: "get",
            dataType: "json",

            success: function(result)
            {
                $("#this-year-sales").html(formatMoney(result.this_year_sales))
                if(result.since_last_month < 0)
                {
                    $("#percent-change-since-last-month").addClass("text-danger");
                    $("#percent-change-since-last-month").html("<i class='fas fa-arrow-down'></i> "+result.since_last_month+"%");
                }
                else
                {
                    $("#percent-change-since-last-month").addClass("text-success");
                    $("#percent-change-since-last-month").html("<i class='fas fa-arrow-up'></i> "+result.since_last_month+"%");
                }

                var $salesChart = $('#sales-chart')
                var salesChart  = new Chart($salesChart, {
                    type   : 'bar',
                    data   : {
                        labels  : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                        datasets: [
                            {
                                backgroundColor: '#007bff',
                                borderColor    : '#007bff',
                                data           : result.product_sales 
                            },
                            {
                                backgroundColor: '#6610f2',
                                borderColor    : '#6610f2',
                                data           : result.subscription_sales 
                            },
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips           : {
                            mode     : mode,
                            intersect: intersect
                        },
                        hover              : {
                            mode     : mode,
                            intersect: intersect
                        },
                        legend             : {
                            display: false
                        },
                        scales             : {
                            yAxes: [{
                            // display: false,
                            gridLines: {
                                display      : true,
                                lineWidth    : '4px',
                                color        : 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks    : $.extend({
                                beginAtZero: true,

                                // Include a naira sign in the ticks
                                callback: function (value, index, values) {
                                    if (value >= 1000000) {
                                        value /= 1000000
                                        value += 'm'
                                    }
                                    else if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }
                                    return '<?=currency()?> ' + value
                                }
                            }, ticksStyle)
                            }],
                            xAxes: [{
                            display  : true,
                            gridLines: {
                                display: false
                            },
                            ticks    : ticksStyle
                            }]
                        }
                    }
                });
            }
        });


        $.ajax({
            url: "<?=base_url().route_to("admin_route_statistics_salesbyproducts")?>",
            method: "get",
            dataType: "json",

            success: function(result)
            {
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                var pieData = {
                    labels: result.labels,
                    datasets: [
                        {
                            data: result.sales,
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                };
                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                var pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                });
            }
        });

        $.ajax({
            url: "<?=base_url().route_to("admin_route_statistics_subscriptionsbyplans")?>",
            method: "get",
            dataType: "json",

            success: function(result)
            {
                var pieChartCanvas = $('#subscription-by-plans').get(0).getContext('2d')
                var pieData = {
                    labels: result.labels,
                    datasets: [
                        {
                            data: result.sales,
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                };
                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                var pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                });
            }
        });
    });
</script>