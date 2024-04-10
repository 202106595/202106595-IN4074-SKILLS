<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Contact Us</title>
</head>

<body>
    <header>
        <h1>Contact Us</h1>
        <p>Have questions? Reach out to us!</p>
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
    </header>

    <section class="main-content">
   
        <form id="contactForm" action="#" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <input type="submit" value="Submit">
        </form>
    </section>

    <footer>
    <p>&copy; 2024 My Gym. All rights reserved to Jasmeet Singh 202106595.</p>
    </footer>

    <script src="script.js"></script>
</body>

</html>