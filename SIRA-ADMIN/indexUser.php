<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIRA | Presentaciones</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <?php require('../sesion.php'); ?>
  <?php include('headerLinks.php')?>
  <?php include('BD_Consultas\Grupos.php')?>
  <?php include('BD_Consultas\userPresentaciones.php')?>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<!--  -->
  <?php include('userNav.php')?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Presentaciones</h1>
    </section>
    <div class="modal modal-info fade" role="dialog"  id="viewPresentation-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Presentación</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                      <input id="inName" type="text"   class="form-control" name="inEventName"   placeholder="Nombre" disabled>
                      <input id="inDate" type="date"   class="form-control" name="inEventDate"   disabled/>
                      <input id="inTime" type="time"   class="form-control" name="inEventTime"   placeholder="Fecha" disabled/>
                      <input id="inPlace" type="text"   class="form-control" name="inEventPlace"  placeholder="Lugar" disabled>
                      <input id="inCost" type="number" class="form-control" name="inEventCost"   placeholder="Costo" disabled>
                      <textarea id="inDescription" rows="4"   class="form-control" name="inEventDetail" placeholder="Descripción" style="resize: none;"   disabled></textarea>
                      <input id="inId" type="hidden" name="inEventId">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
        <div class="row-md-7 center">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <div id="calendar">
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('adminFooter.php')?>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- fullCalendar -->
<script src="bower_components/moment/moment.js"></script>
<script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src='"bower_components/fullcalendar/dist/locale/es.js'></script>



<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
    -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
    -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
    m    = date.getMonth(),
    y    = date.getFullYear()
    $('#calendar').fullCalendar({

      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week : 'Semana',
        day  : 'Día'
      },
      //Random default events
      events    : [
      <?php getPresentaciones(); ?>
      ],
      eventClick: function(event) {

          $(inName).val(event.title);
          $(inDescription).val(event.description);
          $(inDate).val(event.start.toISOString().substr(0, 10));
          $(inTime).val(event.time);
          $(inPlace).val(event.place);
          $(inCost).val(event.cost);
          $(inId).val(event.id);
          $("#viewPresentation-modal").modal('show');
      },
      editable  : false,
      droppable : false, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

    }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)


      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
<script>function changeColor(color){
  var c = document.getElementById('color');
  c.value = color;
  var s = document.getElementById('submitButton');
  s.style = "background:"+color;
}
</script>
</body>
</html>
