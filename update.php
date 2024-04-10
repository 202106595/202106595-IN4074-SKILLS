<?php
// Include config file
require_once "config.php"; 

// Define variables and initialize with empty values
$member_name = $membership_type = $joining_date = $payment_status = "";
$member_name_err = $membership_type_err = $joining_date_err = $payment_status_err = "";


// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

     // Validate Member Name
     $input_member_name = trim($_POST["member_name"]);
     if (empty($input_member_name)) {
         $member_name_err = "Please enter the Member Name.";
     } else {
         $member_name = $input_member_name;
     }

    // Validate Membership type
    $input_membership_type = trim($_POST["membership_type"]);
    if (empty($input_membership_type)) {
        $membership_type_err = "Please enter Membership type.";
    } else {
        $membership_type = $input_membership_type;
    }

    // Validate Joining date
    $input_joining_date = trim($_POST["joining_date"]);
    if (empty($input_joining_date)) {
        $joining_date_err = "Please enter an Joining date.";
    } else {
        $joining_date = $input_joining_date;
    }

    // Validate Payment status
    $input_payment_status = trim($_POST["payment_status"]);
    if (empty($input_payment_status)) {
        $payment_status_err = "Please enter the Payment status.";
    } else {
        $payment_status = $input_payment_status;
    }

    // Check input errors before inserting in database
    if (empty($member_name_err) && empty($membership_type_err) && empty($joining_date_err) && empty($payment_status_err)) {
        // Prepare an update statement
$sql = "UPDATE gymmembers SET member_name=?, membership_type=?, joining_date=?, payment_status=? WHERE id=?";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssssi", $param_member_name, $param_membership_type, $param_joining_date, $param_payment_status, $param_id);

    // Set parameters
    $param_member_name = $member_name;
    $param_membership_type = $membership_type;
    $param_joining_date = $joining_date;
    $param_payment_status = $payment_status;
    $param_id = $id;

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Records updated successfully. Redirect to landing page
        header("location: index.php");
        exit();
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM gymmembers WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

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
                    // URL doesn't contain valid id. Redirect to error page
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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

            h2 {
              font-weight: bold;
              font-family: georgia;
              color: #15213B; 
              font-size: 36px;
                }
            p{
                font-weight: bold; 
                font-family: serif;
                font-size: 20px; 
            }
            label{
                font-weight: bold;
                font-family: serif;  
                font-size: 20px; 
            }
            .btn-primary {
    background-color: #15213B; 
    color: black; 
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-secondary {
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btnprimary:hover {
    background-color: #617389; 
}
  
   </style>
    
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the Gym Members information.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                            <label>Member Name</label>
                            <input type="text" name="member_name" class="form-control <?php echo (!empty($member_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $member_name; ?>">
                            <span class="invalid-feedback"><?php echo $member_name_err; ?></span>
                        </div>   
                    <div class="form-group">
                            <label>Membership type</label>
                            <input type="text" name="membership_type" class="form-control <?php echo (!empty($membership_type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $membership_type; ?>">
                            <span class="invalid-feedback"><?php echo $membership_type_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Joining date</label>
                            <input type="text" name="joining_date" class="form-control <?php echo (!empty($joining_date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $joining_date; ?>">
                            <span class="invalid-feedback"><?php echo $joining_date_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Payment status</label>
                            <input type="text" name="payment_status" class="form-control <?php echo (!empty($payment_status_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $payment_status; ?>">
                            <span class="invalid-feedback"><?php echo $payment_status_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="demo.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
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