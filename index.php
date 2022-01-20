<?php

include "config.php";

?>

<!doctype html>

<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<body>

  <!-- CSS -->

  <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>







  <!-- Search filter -->

  <form method='post' action=''>

    Start Date <input type='datetime-local' class='dateFilter' name='fromDate' value='<?php if (isset($_POST['fromDate'])) echo $_POST['fromDate']; ?>'>



    End Date <input type='datetime-local' class='dateFilter ' name='endDate' value='<?php if (isset($_POST['endDate'])) echo $_POST['endDate']; ?>'>




    <button type="submit" name='but_search' value='Search' class="btn btn-primary"> Filter </button>






    <!-- Employees List -->

    <div style='height: 80%; overflow: auto;'>



      <table border='1' width='100%' style='border-collapse: collapse;margin-top: 20px;'>

        <tr>

          <th>id</th>

          <th>Kode Arah</th>

          <th>Waktu</th>

          <!-- <th>Email</th> -->

        </tr>



        <?php

        $emp_query = "SELECT * FROM cardetections where 1";


        // Date filter 

        if (isset($_POST['but_search'])) {

          $fromDate = $_POST['fromDate'];

          $endDate = $_POST['endDate'];



          if (!empty($fromDate) && !empty($endDate)) {

            $emp_query .= " and timestamp  

                          between '" . $fromDate . "' and '" . $endDate . "' ";

            // print_r($emp_query);
          }
        }



        // Sort 

        $emp_query .= " ORDER BY timestamp ASC";

        $employeesRecords = mysqli_query($con, $emp_query);


        // Check records found or not 

        if (mysqli_num_rows($employeesRecords) > 0) {
          // print_r($employeesRecords);


          while ($empRecord = mysqli_fetch_assoc($employeesRecords)) {
            // foreach ($empRecord as $value) {
            // }
            // print_r($empRecord['id']);


            $id = $empRecord['id'];

            $empName = $empRecord['arah'];

            $date_of_join = $empRecord['timestamp'];

            // $gender = $empRecord['gender'];

            // $email = $empRecord['email'];



            echo "<tr>";

            echo "<td>" . $id . "</td>";
            echo "<td>" . $empName . "</td>";

            echo "<td>" . $date_of_join . "</td>";

            // echo "<td>" . $gender . "</td>";

            // echo "<td>" . $email . "</td>";

            echo "</tr>";
          }
        } else {

          echo "<tr>";

          echo "<td colspan='4'>No record found.</td>";

          echo "</tr>";
        }

        ?>

      </table>



    </div>

    <!-- Script -->

    <script src='jquery-3.3.1.js' type='text/javascript'></script>

    <script src='jquery-ui.min.js' type='text/javascript'></script>

    <script type='text/javascript'>
      $(document).ready(function() {

        $('.dateFilter').datepicker({

          dateFormat: "yy-mm-dd"

        });

      });
    </script>

</body>

</html>