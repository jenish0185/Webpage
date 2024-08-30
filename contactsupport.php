<?php
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo "<script>console.log('User ID:', $user_id);</script>";
} else {
    // Handle the case where user ID is not provided
    // For example, redirect the user to an error page or ask them to log in again
    // This depends on your application's logic
    header("Location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vroom - Favorites</title>
        <link rel="stylesheet" href="contactsuppot.css">
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
      </head>
    <style>
        

        .chat-icon {
            background-color: antiquewhite;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .chat-icon img {
            width: 30px;
            height: 30px;
        }

        .chat-icon:hover {
            background-color: #6C25E1;
            /* Change color on hover */
        }


        .chat-popup {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 400px;
            height: 500px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            display: none;
            z-index: 1000;
        }

        .chat-header {
            background-color: #7B2CF8;
            color: white;
            padding: 10px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-body {
            padding: 10px;
            max-height: 400px;
            overflow-y: auto;
        }

        .chat-input {
            width: calc(100% - 20px);
            padding: 10px;
            border: none;
            border-top: 1px solid #ccc;
            resize: none;
            outline: none;
            font-size: 14px;
        }

        .chat-input:focus {
            border-color: #7B2CF8;
        }

        .chat-submit {
            background-color: #7B2CF8;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .close-btn {
            background-color: #ccc;
            color: #333;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
     <header>
        
        <div class="branding">
            <h1 class="vroom-text">Vroom</h1>
            <p class="slogan-text">Drive, Explore, and Repeat</p>
        </div>
        <nav>
            <div class="nav-links">
                <a href="customerdash.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('customerdash.php', this)">Car rentals</a>
                <a href="favorites.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('favorites.html', this)">Favorites</a>
                <a href="book-history.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('book-history.html', this)">Booking History</a>
                <a href="settings.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('settings.php', this)">Settings</a>
            </div>
        </nav>
        <div class="currency-selector">
            <button class="currency-btn">NPR</button>
            <div class="profile-picture"></div>
        </div>
        <button class="manage-btn">Manage Bookings</button>
    </header>
    </header>

    <div class="content">
        <h2>Contact & Support</h2>
        <p>For any inquiries or assistance, please feel free to reach out to us:</p>
    
        <div class="contact-info">
            <div class="contact-item">
                <h3>Customer Support</h3>
                <p><i class="fas fa-envelope"></i> Email: <a href="mailto:support@vroom.com">support@vroom.com</a></p>
                <p><i class="fas fa-phone"></i> Phone: +1234567890</p>
            </div>
            <div class="contact-item">
                <h3>Head Office</h3>
                <p><i class="fas fa-map-marker-alt"></i> Address: 123 Vroom St, Cityville</p>
                <p><i class="far fa-clock"></i> Hours: Mon-Fri, 9am-5pm</p>
            </div>
        </div>
    </div>
    

   
    <div class="chat-icon" onclick="toggleChat()">
        <img src="chatbot.png" alt="Message Icon">
    </div>


    <!-- Chatbot Popup -->
    <div class="chat-popup" id="chatPopup">
        <div class="chat-header">
            Chat with Us
            <button class="close-btn" onclick="closeChat()">Close</button>
        </div>
        <div class="chat-body">
            <!-- Chat messages will be appended here -->
        </div>
        <textarea class="chat-input" placeholder="Type your message..." id="chatInput"></textarea>
        <button class="chat-submit" onclick="sendMessage()">Send</button>
    </div>

    <script>
        function toggleChat() {
            const chatPopup = document.getElementById('chatPopup');
            chatPopup.style.display = chatPopup.style.display === 'block' ? 'none' : 'block';
        }

        function closeChat() {
            const chatPopup = document.getElementById('chatPopup');
            chatPopup.style.display = 'none';
        }

        function sendMessage() {
            const chatInput = document.getElementById('chatInput');
            const message = chatInput.value.trim();

            if (message !== '') {
                // Send the message via email to yeppy761@gmail.com
                const mailtoLink = 'mailto:yeppy761@gmail.com?subject=Message from Vroom&body=' + encodeURIComponent(message);
                window.location.href = mailtoLink;

                const chatBody = document.querySelector('.chat-body');
                const userMessage = document.createElement('div');
                userMessage.textContent = message;
                userMessage.classList.add('user-message');
                chatBody.appendChild(userMessage);

                // Simulate bot response after a short delay
                setTimeout(() => {
                    const botResponse = document.createElement('div');
                    let responseText = '';

                    // Sample responses based on user message
                    if (message.toLowerCase().includes('problem')) {
                        responseText = 'I\'m sorry to hear that. Could you please describe the issue in more detail?';
                    } else if (message.toLowerCase().includes('booking')) {
                        responseText = 'Let me assist you with your booking. What specific information do you need?';
                    } else {
                        responseText = 'Hello! How can we assist you today?';
                    }

                    botResponse.textContent = responseText;
                    botResponse.classList.add('bot-message');
                    chatBody.appendChild(botResponse);

                    // Scroll to the bottom of chat body
                    chatBody.scrollTop = chatBody.scrollHeight;
                }, 500);

                // Clear input after sending message
                chatInput.value = '';
            }
        }
    </script>

</body>

</html>