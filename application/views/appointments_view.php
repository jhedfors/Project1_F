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
  <?php

   ?>
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
      <h6>Hello, <?php echo $this->session->userdata('first_name') ?></h6>
      <p>
        Here are your appointments for today, <?php echo date("M d, Y")  ?>:
      </p>
      <table>
        <thead>
          <tr>
            <th>
              Tasks
            </th>
            <th>
              Time
            </th>
            <th>
              Status
            </th>
            <th>
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($appointments)) {

              foreach ($appointments as $appointment) {
                $current_date = date("Ymd");
                $appointment_date= date("Ymd", strtotime($appointment['date_time']));

                if(($current_date) == $appointment_date) {

              ?>
              <tr>
                <td>
                  <?php echo $appointment['task'] ?>
                </td>
                <td>
                  <?php echo date("h:i",strtotime($appointment['date_time'])) ?>
                </td>
                <td>
                  <?php echo $appointment['status'] ?>
                </td>
                <td>
                  <a href="/appointments/<?php echo $appointment['appointment_id'] ?>">Edit</a>  <a href="delete/<?php echo $appointment['appointment_id'] ?>">Delete</a>
                </td>
              </tr>
              <?php
                }
              }

          }
          ?>
        </tbody>
      </table>
      <p>
        Your Other appointments:
      </p>
      <table>
        <thead>
          <th>
            Tasks
          </th>
          <th>
            Date
          </th>
          <th>
            Time
          </th>
        </thead>
        <tbody>
          <?php
        if (isset($appointments)) {
          foreach ($appointments as $appointment) {
            $current_date = date("Ymd");
            $appointment_date= date("Ymd", strtotime($appointment['date_time']));
            if(($current_date) !== $appointment_date  ) {
          ?>
          <tr>
            <td>
              <?php echo $appointment['task'] ?>
            </td>
            <td>
              <?php echo date("M d",strtotime($appointment['date_time'])) ?>
            </td>
            <td>
              <?php echo date("h:i",strtotime($appointment['date_time'])) ?>
            </td>
          </tr>
          <?php
              }
            }
          } ?>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col s6">
        <p>
          Add Appointment
        </p>
        <form class="" action="/add" method="post">
          <label for="date">Date</label><input type="date" name="date" value="">
          <label for="time">Time</label><input type="time" name="time" value="">
          <label for="task">Tasks:</label><input type="text" name="task" value="">
          <input type="submit">
        </form>
        <div class="errors">
          <?php
          $errors =$this->session->userdata('errors');
          if($errors){
            foreach ($errors as $error) {
              echo $error;
            }
          }
          $this->session->set_userdata('errors',[validation_errors()]);
           ?>
        </div>
      </div>

    </div>

  </div>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>
  </body>
</html>
