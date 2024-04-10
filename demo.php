<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gymmembers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        .btn {
    background-color: #303162; 
    color: #ffffff; 
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
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
}
.btn:hover {
    background-color: #9f6767; 
}
        table tr td:last-child {
            width: 120px;
        }
        td {
            font-weight: bold;
        }
        th {
            color: #303162;
        }
        p {
   font-family: Georgia, serif;
   font-size: 20px;
   font-weight: bold;
   padding-left: 30px;
   padding-right: 30px;
}
img {
	display: block;
	margin: auto;
  border: 3px solid black;
}         
    </style>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
   <!--     -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                    <img src="img/pic2.jpeg" alt="Gym Image" width="300" height="300">
                        <h2 class="pull-left">Gym Members Record</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Record</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                   
                    // Attempt select query execution 
                    $sql = "SELECT * FROM gymmembers";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>id</th>";
                            echo "<th>member_name</th>";
                            echo "<th>membership_type</th>";
                            echo "<th>joining_date</th>";
                            echo "<th>payment_status</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['member_name'] . "</td>";
                                echo "<td>" . $row['membership_type'] . "</td>";
                                echo "<td>" . $row['joining_date'] . "</td>";
                                echo "<td>" . $row['payment_status'] . "</td>";
                                echo "<td>";
                                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No Record were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
  <!-- Footer Section -->
  <footer>
    <p>&copy; 2024 My Gym. All rights reserved to Jasmeet Singh 202106595.</p>
  </footer>