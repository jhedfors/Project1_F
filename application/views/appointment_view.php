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
  <nav class="teal darken-2">
    <div class="nav-wrapper container">
      <h4 class = "left">What's Up</h4>
      <ul id= "nav" class="right">
        <li><a href="/appointments">Home</a></li>
        <li><a href="/logout">Logout</a></li>
      </ul>
   </div>
  </nav>
  </nav>
   <div class="row container">
     <div class="col s12">
       <div class="errors">
         <?php echo validation_errors() ?>
       </div>
     </div>
   </div>
   <div class="row container">
     <div class="col s6">
       <form class="" action="/appointments/modify_form" method="post">
          <label for="task">Tasks:</label><input type="text" name="task" value="<?php echo $appointment['task'] ?>">
          <label for="status">Status:</label>
          <div class="">
            <select class="browser-default" name="status" >
              <option value = "Done" <?php echo($appointment['status'] == "Done" ?  "selected" : "") ?> >Done</option>
              <option value = "Pending" <?php echo($appointment['status'] == "Pending" ?  "selected" : "") ?>>Pending</option>
              <option value = "Missed" <?php echo($appointment['status'] == "Missed" ?  "selected" : "") ?>>Missed</option>
            </select>
          </div>
         <label for="date">Date</label><input type="date" name="date" value="<?php echo date("Y-m-d",strtotime($appointment['date_time'])) ?>">
         <label for="time">Time</label><input type="time" name="time" value="<?php echo date("H:i",strtotime($appointment['date_time'])) ?>">
         <input type="hidden" name="id" value="<?php echo $appointment['id'] ?>">
         <input class="btn" type="submit">
       </form>
     </div>
   </form>
   </div>
   <div class="errors">
     <?php
     $errors =$this->session->userdata('errors');
     foreach ($errors as $error) {
       echo $error;
     }
     $this->session->set_userdata('errors',[validation_errors()]);
      ?>
   </div>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>
  </body>
</html>
