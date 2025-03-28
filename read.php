<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM gymmembers WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $member_name = $row["member_name"];
                $membership_type = $row["membership_type"];
                $joining_date = $row["joining_date"];
                $payment_status = $row["payment_status"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Navigation Section -->
  <nav>
  <ul>
  <li><a href="index.php">Index Page</a></li>
        <li><a href="demo.php">Demonstration</a></li>
        <li><a href="resources.html">Resources</a></li>
        <li><a href="me.html">About me</a></li>
        <li><a href="create.php">Add Record</a></li>
        <li><a href="index.html">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
  </nav>

    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
        ul {
          list-style-type: circle;
          margin: 10px;
          padding: 14px;
          overflow: hidden;
          background-color: #E5EEFE;
          font-size: 30px;
          font-weight: bold;
          border-style: solid;
          border-color: #21344C;
          }
          
          li {
          float: left;
          }
          
          li a {
          display: block;
          color: #21344C;
          text-align: center;
          padding: 10px 50px;
          }
          
          li a:hover:not(.active) {
          background-color:#CEDFFB;
          }
          
          .active {
            background-color: #8586a2;
              }
            h1 {
              font-weight: bold;
              font-family: georgia;
              color: #15213B;
              font-size: 38px;
                }
            p{
                font-weight: bold; 
                font-family: serif;
                font-size: 18px; 
            }
            label{
                font-family: serif;  
                font-size: 20px;
                color: #15213B; 
                font-weight: bold;
            }
            .btn {
    background-color: #15213B; 
    color: #ffffff; 
    border: none;
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn:hover {
    background-color:#617389; 
}
  
    </style>
   
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Member Name</label>
                        <p><b><?php echo $row["member_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Membership type city</label>
                        <p><b><?php echo $row["membership_type"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Joining date</label>
                        <p><b><?php echo $row["joining_date"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Payment status</label>
                        <p><b><?php echo $row["payment_status"]; ?></b></p>
                    </div>
                    <p><a href="demo.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
 <!-- Footer Section -->
 <footer>
   <p>&copy; 2024 My Gym. All rights reserved to Jasmeet Singh 202106595.</p>
  </footer>
</html>