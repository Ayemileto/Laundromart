   <!-- fullCalendar 2.2.5 -->
    <script src="<?=assetUrl("/plugins/moment/moment.min.js")?>"></script>
    <script src="<?=assetUrl("/plugins/fullcalendar/main.min.js")?>"></script>
    <script src="<?=assetUrl("/plugins/fullcalendar-daygrid/main.min.js")?>"></script>
    <script src="<?=assetUrl("/plugins/fullcalendar-timegrid/main.min.js")?>"></script>
    <script src="<?=assetUrl("/plugins/fullcalendar-interaction/main.min.js")?>"></script>
    <script src="<?=assetUrl("/plugins/fullcalendar-bootstrap/main.min.js")?>"></script>


<?=view('includes/js/modal')?>
    
<script>
    function showCalendar(source_url)
    {
        $("#calendar").html("");
        /* initialize the calendar
        -----------------------------------------------------------------*/
        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------
        var calendar = new Calendar(calendarEl, {
        timeZone: '<?=siteTimezone()?>',
        locale: '<?=siteLanguage()?>',
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
        header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        'firstDay': 1,
        'themeSystem': 'bootstrap',
        'eventTimeFormat': {
            omitZeroMinute: false,
            hour: '2-digit',
            minute: '2-digit',
            hour12: false,
        },
        eventClick: function(info) {
            info.jsEvent.preventDefault(); // don't let the browser navigate

            if (info.event.url) {
                showModal(info.event.url, info.event.title);
            }
        },
        'displayEventEnd': true,
        events    : source_url,
        editable  : false,
        droppable : false, // this allows things to be dropped onto the calendar !!!   
        });

        calendar.render();
    }
</script>