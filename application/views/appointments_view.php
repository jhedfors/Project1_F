<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>What's Up</title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>
</head>
<body>
  <nav>
    <div class="nav-wrapper container">
      <h4 class = "left">What's Up</h4>
      <ul id= "nav" class="right">
        <li><a href="/appointments">Home</a></li>
        <li><a href="/logout">Logout</a></li>
      </ul>
   </div>
  </nav>
  <div class="container section">
    <div class="row">
      <div class="col s12">
        <h4>Hello, <?php echo $this->session->userdata('first_name') ?></h4>
        <div class="section">
          <h5>
            Here are your appointments for today, <?php echo date("M d, Y")  ?>:
          </h5>
          <table class="section">
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
                        <?php echo date("h:i A",strtotime($appointment['date_time'])) ?>
                      </td>
                      <td>
                        <?php echo $appointment['status'] ?>
                      </td>
                      <td>
                        <a href="done/<?php echo $appointment['appointment_id'] ?>">Done</a> |
                        <a href="/appointments/<?php echo $appointment['appointment_id'] ?>">Edit</a> | <a href="delete/<?php echo $appointment['appointment_id'] ?>">Delete</a>
                      </td>
                    </tr>
                    <?php
                  }
                }
              }
              ?>
            </tbody>
          </table>

        </div>
        <div class="section">
          <h5>
            Upcoming appointments:
          </h5>
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
              <th>
                Action
              </th>
            </thead>
            <tbody>
              <?php
              if (isset($appointments)) {
                foreach ($appointments as $appointment) {
                  $current_date = date("Ymd");
                  $appointment_date= date("Ymd", strtotime($appointment['date_time']));
                  if(($current_date) < $appointment_date  ) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $appointment['task'] ?>
                      </td>
                      <td>
                        <?php echo date("M d",strtotime($appointment['date_time'])) ?>
                      </td>
                      <td>
                        <?php echo date("h:i A",strtotime($appointment['date_time'])) ?>
                      </td>
                      <td>
                        <a href="/appointments/<?php echo $appointment['appointment_id'] ?>">Edit</a>  <a href="delete/<?php echo $appointment['appointment_id'] ?>">Delete</a>
                      </td>
                    </tr>
                    <?php
                  }
                }
              } ?>
            </tbody>
          </table>
        </div>
        <!-- Modal Trigger -->
        <div class="section">
          <a href="#new_appointment" class="section btn-floating right btn-large waves-effect waves-light red modal-trigger"><i class="material-icons">add</i></a>
          <div id="new_appointment" class="modal">
            <!-- Modal Structure -->
            <div class="modal-content">
              <h5>
                Add Appointment
              </h5>
              <form class="" action="/add" method="post">
                <label for="date">Date</label><input type="date" name="date" value="">
                <label for="time">Time</label><input type="time" name="time" value="">
                <label for="task">Tasks:</label><input type="text" name="task" value="">
                <div class="modal-footer">
                  <input class="modal-action waves-effect waves-green btn-flat" type="submit" value="Add Appointment">
                </div>
              </form>
              <div class="errors">
                <?php
                $errors =$this->session->userdata('errors');
                if(strlen($errors{0})){
                  echo '<script type="text/javascript">';
                  echo "$('#new_appointment').openModal()";
                  echo '</script>';
                  foreach ($errors as $error) {
                    echo $error;
                  }
                }
                $this->session->set_userdata('errors',[validation_errors()]);
                ?>
              </div>
            </div>
          </div>
          <div class="section">
            <h5>
              Past appointments:
            </h5>
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
                <th>
                  Action
                </th>
                <th>
                  Status
                </th>
              </thead>
              <tbody>
                <?php
                if (isset($appointments)) {
                  foreach ($appointments as $appointment) {
                    $current_date = date("Ymd");
                    $appointment_date= date("Ymd", strtotime($appointment['date_time']));
                    if(($current_date) > $appointment_date  ) {
                      ?>
                      <tr>
                        <td>
                          <?php echo $appointment['task'] ?>
                        </td>
                        <td>
                          <?php echo date("M d",strtotime($appointment['date_time'])) ?>
                        </td>
                        <td>
                          <?php echo date("h:i A",strtotime($appointment['date_time'])) ?>
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
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
