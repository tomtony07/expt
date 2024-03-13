<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Travel Agency</title>
  <link rel="stylesheet" href="about_us.css"> <!-- Link to your CSS file -->
</head>
<body>
  <section class="nav-bar">
    <div class="logo">Go Trip</div>
    <ul class="menu">
      <li><a href="pro.html">home</a></li>
      <li><a href="#">tours</a></li>
      <li><a href="#">package</a></li>
      <li><a href="#">blog</a></li>
      <li><a href="about_us.html">about us</a></li>
      <li><a href="login.html">logout</a></li>
    </ul>
  </section>

  <header>
    <!-- Header content here -->
  </header>
  <div class="registerdata-table">
    
    
      <?php
      $servername = "127.0.0.1";
      $username = "root";
      $password = "";
      $dbname = "travel_agency"; // your database name
      
      $conn = new mysqli($servername, $username, $password, $dbname);
      
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 
      
      $sql = "SELECT * FROM package";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo '<table border="1">';
        echo '<tr><th>PackageID</th><th>Name</th><th>Description</th><th>Price</th><th>Duration</th><th>Destination Name</th><th>Departure Date</th><th>Image URL</th></tr>';

        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row["PackageID"] . '</td>';
          echo '<td>' . $row["Name"] . '</td>';
          echo '<td>' . $row["Description"] . '</td>';
          echo '<td>' . $row["Price"] . '</td>';
          echo '<td>' . $row["Duration"] . '</td>';
          echo '<td>' . $row["DestinationName"] . '</td>';
          echo '<td>' . $row["Departure_date"] . '</td>';
          echo '<td>' . $row["image_url"] . '</td>';
          echo '</tr>';
        }

        echo '</table>';
      } else {
        echo 'No records found';
      }
      ?>
    </div>

  <main>
    <section class="about">
      <div class="about-content">
        <h2>New Packages</h2>
      </div>
    </section>
  </main>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details from Database</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Details from Database</h1>
        <div class="details">
            <div class="detail" id="detail">
                <!-- Details will be filled in dynamically using JavaScript -->
            </div>
        </div>
    </div>

    <script>
        // Function to fetch data from the PHP file using AJAX
        function fetchData() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    document.getElementById('detail').innerHTML = `
                        <img src="data:image/jpeg;base64,${data.image_url}" alt="Image">
                        <h2>Destination: ${data.destination}</h2>
                        <p>Package_id: ${data.package_id}</p>
                        <p>Package_name: ${data.package_name}</p>
                        <p>Description: ${data.description}</p>
                        <p>Price: ${data.price}</p>
                        <p>Depature: ${data.depature}</p>
                        <p>Depature_date: ${data.depature_date}</p>
                        <!-- Add more details here as needed -->
                    `;
                }
            };
            xhttp.open("GET", "fetch_details.php", true);
            xhttp.send();
        }

        // Call the fetchData function when the page loads
        window.onload = function() {
            fetchData();
        };
    </script>
</body>
</html>