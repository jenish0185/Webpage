<?php
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo "<script>console.log('User ID:', $user_id);</script>";
} else {
    // Redirect back to the login page if user_id parameter is missing
    header("Location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vroom - Car Rentals</title>
  <link rel="stylesheet" href="admindash.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap"
    />
    <style>
       /* Overlay styles */
        .overlay {

        position: center;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
        backdrop-filter: blur(8px); /* Blurred effect */
        z-index: 1000; /* Ensure it's above other content */
        display: none; /* Hide initially */
        }

        /* Panel styles */
        .panel {
        width: 500px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2000;
        border: 2px solid #000;
        padding: 20px;
        text-align: center;
        border-radius: 12px;
        background-color: #fff;
        }


        /* Container styles */
        .container {
        position: relative;
        z-index: 2000; /* Ensure it's above the overlay */
        padding: 20px; /* Add padding */
        }



        /* Styles for input and select elements */
        .panel input[type="text"],
        .panel select,
        .panel input[type="number"] {
        margin-bottom: 10px; /* Add bottom margin */
        width: calc(100% - 20px); /* Full width with padding */
        padding: 8px; /* Add padding */
        box-sizing: border-box; /* Include padding and border in element's total width and height */
        }

        .panel button {
        margin-top: 20px;
        }

        /* Adjustments for file input */
        .panel input[type="file"] {
        display: none; /* Hide the original file input */
        }

        /* Custom file upload styles */
        .file-upload {
        margin-top: 10px;
        position: relative;
        width: calc(100% - 20px);
        }

        .upload-btn {
        color: #333;
        text-decoration: underline;
        cursor: pointer;
        }

        .file-display {
        margin-top: 5px;
        }

        .file-display a {
        color: blue;
        text-decoration: none;
        }

        .button {
        background-color: #4285F4;
        color: #ffffff;
        border: none;
        padding: 20px 40px; /* Larger padding for bigger buttons */
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px; /* Increase font size */
        transition: background-color 0.3s ease; /* Smooth transition for hover effect */
        }

        .button:hover {
        background-color: #3367D6; /* Darker shade of blue on hover */
        }

        .update-btn {
        width: 150px;
        height: 50px;
        background-color: #119F1F;
        color: white; /* Set text color to white */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 50px; /* Add margin to the left */
        }

        /* Apply styles to anchor tag within .update-btn */
        .update-btn a {
        text-decoration: none; /* Remove underline */
        color: white; /* Set text color to white */
        }

        /* Update existing or add new CSS styles */
        .host-btn {
            position: absolute;
            top: 10px; /* Adjust the top position as needed */
            right: 10px; /* Adjust the right position as needed */
            z-index: 100; /* Ensure it's above other elements */
        }

          /* New styles for the contact panel */
      #contact {
        margin-top: 250px;
        margin-bottom: 0;
        height: 60vh; /* Adjust height as needed */
        background-color: #12042a; /* Set background color to black */
        color: #fff; /* Set text color to white */
        padding: 50px; /* Add padding */
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
      }

      /* Style for the headers */
      .contact-header {
        font-size: 24px;
        margin-bottom: 10px;
      }

      /* Adjust margins for the headers */
      .vroom-header {
        margin-right: 20px;
      }

      .about-vroom-header {
        margin-right: 20px;
      }

      .top-brands-header {
        margin-right: 20px;
      }

      /* Style for the list items */
      .contact-list {
        list-style: none;
        padding: 0;
        margin-top: 10px;
      }

      .contact-list-item {
        margin-bottom: 8px;
      }

      .contact-list-item:last-child {
        margin-bottom: 0;
      }

      /* Style for socials header */
      .socials-header {
        margin-bottom: 10px; /* Add margin to create space between the header and icons */
      }

      /* Style for social icons */
      .socials {
        display: flex;
        flex-direction: column;
      }

      .social {
        display: flex;
        align-items: center; /* Align items vertically */
        margin-bottom: 10px; /* Add margin to create space between each social icon and name */
      }

      .social a {
        text-decoration: none;
        color: inherit; /* Inherit color from parent */
      }

      .social a:hover,
      .social a:focus {
        color: #800080; /* Change color to purple/blue on hover or focus */
      }

      .social img {
        width: 48px; /* Double the width of the image */
        height: 48px; /* Double the height of the image */
        margin-right: 10px;
      }

      .social span {
        color: #fff;
        font-size: 18px; /* Adjust font size for the name */
        font-weight: bold; /* Make the name bold */
      }





    </style>
</head>
<body>
 
  <header>
    <!-- For header/logo  -->
    <div class="branding">
        <a href="index.php?user_id=<?php echo $user['id']; ?>" class="vroom-text">
            <h1>Vroom</h1>
        </a>
        <p class="slogan-text"><a href="index.php?user_id=<?php echo $user['id']; ?>">Drive, Explore, and Repeat</a></p>
    </div>

    <nav>
      <div class="nav-links">
        <a href="admindash.php?user_id=<?php echo $user_id; ?>" class="underline">Car hostings</a>
        <a href="wallet.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('wallet.php', this)">Wallet</a>
        <a href="inbox.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('inbox.php', this)">Inbox</a>
        <a href="setting.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('setting.php', this)">Settings</a>

      </div>
    </nav>
    
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <a href="ManageCarList.php" class="manage-btn">Manage Cars</a>

    <button id="hostButton" onclick="showPanels()">Host</button>
  </header>

  
  
  
  <main>

    
  <div class="car-panel-wrapper">
        <h1>Your Hosted Cars:</h1>
        <?php
        // Establish database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "car_rental";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch car data from the database
        $sql = "SELECT * FROM car_details";
        $result = $conn->query($sql);

        // Output car panels
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                include 'adminCarList.php'; // Include the car panel template
            }
        } else {
            echo "No cars available";
        }

        $conn->close();
        ?>
    </div>





   
      

        <!-- Overlay -->
      <div class="overlay"></div>

      <form id="carForm" method="post" enctype="multipart/form-data" action="process_form.php">
          <!-- First Panel -->
          <div id="firstPanel" class="panel" style="display: none;">
              <h2>Enter Car Details</h2>
              <input type="text" id="carName" name="carName" placeholder="Car Name"><br>
              <select id="carBrand" name="carBrand" style="color: rgba(0, 0, 0, 0.5);">
                <option value="" disabled selected>-----Car Brand-------</option>
                <option value="Toyota">Toyota</option>
                <option value="Honda">Honda</option>
                <option value="Ford">Ford</option>
                <option value="Chevrolet">Chevrolet</option>
                <option value="BMW">BMW</option>
                <option value="Mercedes-Benz">Mercedes-Benz</option>
                <option value="Audi">Audi</option>
                <option value="Volkswagen">Volkswagen</option>
                <option value="Nissan">Nissan</option>
                <option value="Hyundai">Hyundai</option>
                <option value="Kia">Kia</option>
                <option value="Subaru">Subaru</option>
                <option value="Porsche">Porsche</option>
                <option value="Ferrari">Ferrari</option>
                <option value="Lamborghini">Lamborghini</option>
                <option value="Aston Martin">Aston Martin</option>
                <option value="Tesla">Tesla</option>
                <option value="Jaguar">Jaguar</option>
                <option value="Land Rover">Land Rover</option>
                <option value="Jeep">Jeep</option>
                <!-- Add more options here if needed -->
            </select><br>

              
              <!-- Car Type Selector -->
              <select id="carType" name="carType" style="color: rgba(0, 0, 0, 0.5);">
                <option value="" disabled selected>-----Car Type-------</option>
                <option value="SUV">SUV</option>
                <option value="Offroad">Offroad</option>
                <option value="Sports">Sports</option>
                <option value="Sedan">Sedan</option>
                <option value="Hatchback">Hatchback</option>
                <option value="Coupe">Coupe</option>
                <option value="Convertible">Convertible</option>
                <option value="Electric">Electric</option>
                <option value="Hybrid">Hybrid</option>
                <option value="Luxury">Luxury</option>
                <option value="Compact">Compact</option>
                <option value="Microcar">Microcar</option>
                <!-- Add more options as needed -->
            </select><br>

              
              <!-- Car Seats Selector -->
              <select id="carSeats" name="carSeats" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Number of Seats-------</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5+</option>
                  <!-- Add more options here -->
              </select><br>
              
              <!-- Car Space Selector -->
              <select id="carSpace" name="carSpace" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Space (e.g. for luggage)-------</option>
                  <option value="Automatic">1 Small bag</option>
                  <option value="Automatic">1 Large bag</option>
                  <option value="Automatic">2 Large bag</option>
                  <!-- Add more options here -->
              </select><br>
      
              <!-- Car Transmission Selector -->
              <select id="carTransmission" name="carTransmission" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Transmission Type-------</option>
                  <option value="Automatic">Automatic</option>
                  <option value="Manual">Manual</option>
                  <option value="Continuously Variable Transmission (CVT)">Continuously Variable Transmission (CVT)</option>
                  <option value="Automated Manual Transmission (AMT)">Automated Manual Transmission (AMT)</option>
                  <option value="Dual-Clutch Transmission (DCT)">Dual-Clutch Transmission (DCT)</option>
                  <option value="Sequential Manual Transmission (SMT)">Sequential Manual Transmission (SMT)</option>
                  <option value="Tiptronic Transmission">Tiptronic Transmission</option>
                  <!-- Add more options as needed -->
              </select><br>

      
              <!-- Car Engine Selector -->
              <select id="carEngine" name="carEngine" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Engine Type-------</option>
                  <option value="Petrol">Petrol</option>
                  <option value="Diesel">Diesel</option>
                  <option value="Hybrid">Hybrid</option>
                  <option value="Electric">Electric</option>
                  <option value="Plug-in Hybrid">Plug-in Hybrid</option>
                  <!-- Add more options as needed -->
              </select><br>

      
              <!-- Car Mileage Selector -->
              <select id="carMileage" name="carMileage" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Mileage-------</option>
                  <option value="Less than 10,000 miles">Less than 10,000 miles</option>
                  <option value="10,000 - 20,000 miles">10,000 - 20,000 miles</option>
                  <option value="20,000 - 30,000 miles">20,000 - 30,000 miles</option>
                  <option value="30,000 - 40,000 miles">30,000 - 40,000 miles</option>
                  <option value="40,000 - 50,000 miles">40,000 - 50,000 miles</option>
                  <option value="50,000 - 60,000 miles">50,000 - 60,000 miles</option>
                  <option value="60,000 - 70,000 miles">60,000 - 70,000 miles</option>
                  <option value="70,000 - 80,000 miles">70,000 - 80,000 miles</option>
                  <option value="80,000 - 90,000 miles">80,000 - 90,000 miles</option>
                  <option value="90,000 - 100,000 miles">90,000 - 100,000 miles</option>
                  <option value="Over 100,000 miles">Over 100,000 miles</option>
                  <option value="Unlimited">Unlimited</option>
                  <!-- Add more options as needed -->
              </select><br>

      
            
      
              <input type="number" id="carPrice" name="carPrice" placeholder="Price"><br>
      
              <!-- New image field -->
              <div class="file-upload">
                  <label for="carImage" class="upload-btn">Upload Image</label>
                  <input type="file" id="carImage" name="carImage" accept="image/*" class="upload-input" onchange="displayFileName()">
                  <div id="image-display" class="file-display">Drag an image here or <a href="#">upload a file</a></div>
              </div>
      
              <div style="margin-bottom: 150px;"></div>
              <button onclick="goBack()" class="button" style="position: absolute; bottom: 10px; left: 10px;">Back</button>
              <button onclick="nextPanel()" class="button" style="position: absolute; bottom: 10px; right: 10px;">Next</button>
          </div>
      
          <!-- Second Panel -->
          <div id="secondPanel" class="panel" style="display: none;">
              <h2>Select Additional Features</h2>
              <div class="feature">
                  <h3 style="color: blue;">Safety Features:</h3>
                  <input type="checkbox" id="airbags" name="airbags" value="Airbags">
                  <label for="airbags">Airbags</label><br>
                  <input type="checkbox" id="absBrakes" name="absBrakes" value="ABS Brakes">
                  <label for="absBrakes">ABS Brakes</label><br>
                  <input type="checkbox" id="tractionControl" name="tractionControl" value="Traction Control">
                  <label for="tractionControl">Traction Control</label><br>
                  <!-- Add more safety features here -->
              </div><br>
              <div class="feature">
                  <h3 style="color: blue;">Entertainment System:</h3>
                  <input type="checkbox" id="audioSystem" name="audioSystem" value="Audio System">
                  <label for="audioSystem">Audio System</label><br>
                  <input type="checkbox" id="bluetooth" name="bluetooth" value="Bluetooth Connectivity">
                  <label for="bluetooth">Bluetooth Connectivity</label><br>
                  <!-- Add more entertainment features here -->
              </div><br>
              <div class="feature">
                  <h3 style="color: blue;">Technology:</h3>
                  <input type="checkbox" id="navigation" name="navigation" value="Navigation System">
                  <label for="navigation">Navigation System</label><br>
                  <input type="checkbox" id="parkingAssistance" name="parkingAssistance" value="Parking Assistance">
                  <label for="parkingAssistance">Parking Assistance</label><br>
                  <!-- Add more technology features here -->
              </div><br>
              <div class="feature">
                  <h3 style="color: blue;">Comfort Features:</h3>
                  <input type="checkbox" id="airConditioning" name="airConditioning" value="Air Conditioning">
                  <label for="airConditioning">Air Conditioning</label><br>
                  <input type="checkbox" id="heating" name="heating" value="Heating">
                  <label for="heating">Heating</label><br>
                  <!-- Add more comfort features here -->
              </div><br>
      
              
      
              <div style="margin-bottom: 150px;"></div>
              <button onclick="goBack()" class="button" style="position: absolute; bottom: 10px; left: 10px;">Back</button>
              <button onclick="nextPanel2()" class="button" style="position: absolute; bottom: 10px; right: 10px;">Next</button>
          </div>
      
      
          <!-- Third Panel -->
          <div id="thirdPanel" class="panel" style="display: none;">
              <h2>Review Car Details</h2>
              <div id="reviewDetails"></div>
      
              <div style="margin-bottom: 150px;"></div>
              <button onclick="goBack()" class="button" style="position: absolute; bottom: 10px; left: 10px;">Back</button>
              <button id="submitButton" class="button" style="position: absolute; bottom: 10px; right: 10px;" type="button" onclick="document.getElementById('carForm').submit()">Submit</button>


          </div>

      </form>

      
      <script>

        function goBack() {
            var currentPanel = document.querySelector('.panel[style*="display: block"]');
            var previousPanel = currentPanel.previousElementSibling;

            // If the current panel is the first panel, hide the overlay and return to the default page
            if (currentPanel.id === "firstPanel") {
                document.querySelector('.overlay').style.display = 'none';
                window.location.href = "admindash.php"; // Redirect to the default page
            } else {
                // Otherwise, just hide the current panel and show the previous one
                currentPanel.style.display = 'none';
                previousPanel.style.display = 'block';
            }

            // Prevent form submission
            event.preventDefault();
        }

        // Function to go back to the default page and hide overlay
        function goBackToDefaultPage() {
            // Hide the overlay
            document.querySelector('.overlay').style.display = 'none';
            
            // Redirect to the default page
            window.location.href = "admindash.php";
        }




        



        // Function to display the filename when an image is selected
        function displayFileName() {
            const fileInput = document.getElementById('carImage');
            const fileName = fileInput.files[0].name;
            const imageDisplay = document.getElementById('image-display');
            imageDisplay.innerHTML = fileName;
        }

        

        function showPanels() {
            // Show overlay
            document.querySelector('.overlay').style.display = 'block';

            // Show first panel
            document.getElementById("firstPanel").style.display = "block";
            document.getElementById("hostButton").style.display = "block";
            
        }

        function nextPanel() {
            document.getElementById("secondPanel").style.display = "block";
            document.getElementById("firstPanel").style.display = "none";
            // Prevent form submission
            event.preventDefault();
        }

        function nextPanel2() {
            document.getElementById("secondPanel").style.display = "none";
            document.getElementById("thirdPanel").style.display = "block";
            displayReviewDetails();
            // Prevent form submission
            event.preventDefault();
        }

        // Function to submit the form
function submitForm() {
    // Disable the submit button to prevent multiple submissions
    document.getElementById("submitButton").disabled = true;

    // Validate first panel fields
    if (!validateFirstPanel()) {
        alert("Please fill out all required fields in the first panel.");
        // Re-enable the submit button if validation fails
        document.getElementById("submitButton").disabled = false;
        return;
    }

    // Serialize form data
    var formData = new FormData(document.getElementById("carForm"));

    // Manually handle checkbox values in the second panel
    var checkboxes = document.querySelectorAll('#secondPanel input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        formData.append(checkbox.name, checkbox.checked ? "1" : "0");
    });

    // Send fetch request
    fetch("process_form.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    })
    .then(data => {
        console.log(data);
        // Re-enable the submit button after the request is completed
        document.getElementById("submitButton").disabled = false;
        // Redirect to the default page after successful submission
        goBackToDefaultPage();
    })
    .catch(error => {
        console.error("Fetch error:", error);
        // Re-enable the submit button if an error occurs
        document.getElementById("submitButton").disabled = false;
    });
}

// Function to validate the first panel fields
function validateFirstPanel() {
    var carName = document.getElementById("carName").value;
    var carBrand = document.getElementById("carBrand").value;
    var carType = document.getElementById("carType").value;
    var carSeats = document.getElementById("carSeats").value;
    var carSpace = document.getElementById("carSpace").value;
    var carTransmission = document.getElementById("carTransmission").value;
    var carEngine = document.getElementById("carEngine").value;
    var carMileage = document.getElementById("carMileage").value;
    var carPrice = document.getElementById("carPrice").value;

    // Check if any of the fields are empty
    if (carName === "" || carBrand === "" || carType === "" || carSeats === "" || carSpace === "" || carTransmission === "" || carEngine === "" || carMileage === "" || carPrice === "") {
        return false; // Return false if any field is empty
    }
    return true; // Return true if all fields are filled
}



        function displayReviewDetails() {
            var reviewDetails = document.getElementById("reviewDetails");
            reviewDetails.innerHTML = "";
            var carName = document.getElementById("carName").value;
            var carBrand = document.getElementById("carBrand").value;
            var carType = document.getElementById("carType").value;
            var carSeats = document.getElementById("carSeats").value;
            var carSpace = document.getElementById("carSpace").value;
            var carTransmission = document.getElementById("carTransmission").value;
            var carEngine = document.getElementById("carEngine").value;
            var carMileage = document.getElementById("carMileage").value;
            var carPrice = document.getElementById("carPrice").value;
            var reviewText = `
                <p><strong>Car Name:</strong> ${carName}</p>
                <p><strong>Car Brand:</strong> ${carBrand}</p>
                <p><strong>Car Type:</strong> ${carType}</p>
                <p><strong>Number of Seats:</strong> ${carSeats}</p>
                <p><strong>Space (e.g. for luggage):</strong> ${carSpace}</p>
                <p><strong>Transmission Type:</strong> ${carTransmission}</p>
                <p><strong>Engine Type:</strong> ${carEngine}</p>
                <p><strong>Mileage:</strong> ${carMileage}</p>
                <p><strong>Price:</strong> ${carPrice}</p>
            `;
            reviewDetails.innerHTML = reviewText;
        }

     

    </script>
    

      
    
    </main>


    


   
  
</body>
</html>
