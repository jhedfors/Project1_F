<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Login/Registration</title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <script type="text/javascript">

$(document).ready(function() {
  $('select').material_select();
});
  </script>
  <nav>
    <div class="nav-wrapper">
      <div class="col s4 left" >
        <h4 class = "left">What's Up</h4>
      </div>

      <div class="col s4 right">
        <a href="/appointments">Home</a> | <a href="/logout">Logout</a>
</div>
   </div>
  </nav>
   <div class="row">
     <div class="col s12">
       <div class="errors">
         <?php echo validation_errors() ?>
       </div>
     </div>
   </div>
   <div class="row">
     <div class="col s6">
       <form class="" action="/main/modify_form" method="post">
          <label for="task">Tasks:</label><input type="text" name="task" value="<?php echo $appointment['task'] ?>">
          <label for="status">Status:</label>
          <div class="">
            <select class="browser-default" name="status" >
              <option value = "Done">Done</option>
              <option value = "Pending">Pending</option>
              <option value = "Missed">Missed</option>
              <option value="<?php echo $appointment['status'] ?>" selected><?php echo $appointment['status'] ?></option>

            </select>
          </div>



          <!-- <input type="text" name="status" value="
          <?php echo $appointment['status'] ?>
          "> -->
         <label for="date">Date</label><input type="date" name="date" value="<?php echo date("Y-m-d",strtotime($appointment['date_time'])) ?>">
         <label for="time">Time</label><input type="time" name="time" value="<?php echo date("h:i",strtotime($appointment['date_time'])) ?>">
         <input type="hidden" name="id" value="<?php echo $appointment['id'] ?>">
         <input type="submit">
       </form>

     </div>

   </div>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>
  </body>
</html>
