

                            


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><?=lang('Site.visitors')?></h3>
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
                        <!-- <p class="d-flex flex-column">
                            <span class="text-bold text-lg" id="visitor-over-time"></span>
                            <span><?=lang('Site.visitors_over_time')?></span>
                        </p> -->
                        <p class="ml-auto d-flex flex-column text-right">
                            <span id="visitor-percent-change">
                            </span>
                            <span class="text-muted"><?=lang('Site.since_last_week')?></span>
                        </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> <?=lang('Site.this_week')?>
                        </span>

                        <span>
                            <i class="fas fa-square text-gray"></i> <?=lang('Site.last_week')?>
                        </span>
                        </div>
                    </div>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->


<?=view("includes/js/chartjs")?>

<script>
    $("document").ready(function() {
        $.ajax({
            url: "<?=fullUrl(route_to("admin_route_visitors_stats"))?>",
            method: "get",
            dataType: "json",

            success:function(data)
            {
                if(data.percent_change < 0)
                {
                    $("#visitor-percent-change").addClass("text-danger");
                    $("#visitor-percent-change").html("<i class='fas fa-arrow-down'></i> "+data.percent_change+"%");
                }
                else
                {
                    $("#visitor-percent-change").addClass("text-success");
                    $("#visitor-percent-change").html("<i class='fas fa-arrow-up'></i> "+data.percent_change+"%");
                }

                $("#visitor-over-time").html(data.all_time);

                let xdata           = [];
                let this_week_data  = [];
                let last_week_data  = [];


                let colors = ["#007bff", "#ced4da"];

                this_week=data.this_week;
                last_week=data.last_week;
                for(var day in this_week)
                {
                    xdata.push(day);
                    this_week_data.push(this_week[day]);
                    last_week_data.push(last_week[day]);
                }

                var ydata_array = [this_week_data, last_week_data];
                
                graphPlotter("visitors-chart", xdata, ydata_array, colors);
            }
        });
    });

    function graphPlotter(element_id, xdata, ydata_array, colors)
    {
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode      = 'index'
        var intersect = true
        var datasets = [];
        var max_array = [];
        var min_array = [];

        for(var index in ydata_array)
        {
            color = colors[index] != undefined ? colors[index] : '#007bff';
            max_array.push(Math.max(...ydata_array[index]));
            min_array.push(Math.min(...ydata_array[index]));

            datasets.push({
                type                : 'line',
                data                : ydata_array[index],
                backgroundColor     : 'transparent',
                borderColor         : color,
                pointBorderColor    : color,
                pointBackgroundColor: color,
                fill                : false
            },);
        }

        var $itemChart = $('#'+element_id)
        var itemChart  = new Chart($itemChart, {
            data   : {
            labels  : xdata,
            datasets: datasets,
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
                    beginAtZero : Math.min(...min_array) == 0 ? true : false,
                    suggestedMax: Math.max(...max_array),
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
</script>
