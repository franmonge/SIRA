<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Calendar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <?php include('headerLinks.php')?>
  <?php include('BD_Consultas\Grupos.php')?>
  <?php include('BD_Consultas\presentaciones.php')?>

  </head>
<body class="hold-transition skin-blue sidebar-mini">

<?php include('adminNav.php')?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Calendar</h1>
    </section>

    <!-- Main content -->

    <form action="BD_Consultas\presentaciones.php" method="POST">
    <section class="content">
      <div class="col-md-12">
        <div class="form-group col-md-6">
          <label>Seleccione el grupo</label>
          <select class="form-control select2" name="group" id="GruposDisponibles" style="width: 100%;">
            <?php dropdownGrupos()?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <!-- <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Presentaciones Creadas</h4>
            </div>
            <div class="box-body">
              <div id="external-events">
                <div class="external-event bg-aqua">Do homework</div>
                <div class="external-event bg-red">Sleep tight</div>
                <div class="checkbox">
                  <label for="drop-remove">
                    <input type="checkbox" id="drop-remove">
                    remove after drop
                  </label>
                </div>
              </div>
            </div>
          </div>
           -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Presentación</h3>
            </div>
            <div class="box-body">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-aqua" onclick="changeColor('#08dfe8');" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-blue" onclick="changeColor('#05729e');" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-light-blue" onclick="changeColor('#0693b7');" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-teal" onclick="changeColor('#08e8de');" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-yellow" onclick="changeColor('#f7b412');" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-orange" onclick="changeColor('#f77b12');" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-green" onclick="changeColor('#06b657');" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-red" onclick="changeColor('#b62b06');"  href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-purple" onclick="changeColor('#6c0456');" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-fuchsia" onclick="changeColor('#e709b8');" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-navy" onclick="changeColor('#26069d');" href="#"><i class="fa fa-square"></i></a></li>
                  <input id="color" type="hidden" value="#08dfe8" name="eventColor">

                </ul>
              </div>
              <!-- /btn-group -->
              <div class="input-group">
                <input type="text"   class="form-control" name="eventName"   placeholder="Nombre" required>
                <input type="date"   class="form-control" name="eventDate"   required/>
                <input type="time"   class="form-control" name="eventTime"   placeholder="Fecha" required/>
                <input type="text"   class="form-control" name="eventPlace"  placeholder="Lugar" required>
                <input type="number" class="form-control" name="eventCost"   placeholder="Costo" required>
                <textarea rows="4"   class="form-control" name="eventDetail" placeholder="Descripción" style="resize: none;"   required></textarea>
              </div>
              <!-- /input-group -->
              <br>
                <div class="input-group-btn">
                  <input id="submitButton" type="submit" class="btn btn-block  btn-flat" value="Crear" style="background:#08dfe8">
                </div>
                <!-- /btn-group -->
              </form>

            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
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
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events    : [
        <?php getPresentaciones(); ?>
      ],
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
      console.log(val);
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
