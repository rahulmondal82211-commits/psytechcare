<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>PsytechCare</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: #f7fdf9;
    }

    /* Navbar */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      background: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #166f3a;
    }

    nav {
      display: flex;
      gap: 20px;
    }

    nav a {
      text-decoration: none;
      color: #166f3a;
      font-weight: 600;
    }

    .logout-btn {
      background: #166f3a;
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    /* Hero Section */
    .hero {
      background: url("1000046064.jpg") no-repeat center/cover;
      color: black;
      text-align: center;

      padding: 120px 20px;
    }

    .hero h1 {
      font-size: 48px;
      margin-bottom: 20px;
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    .hero p {
      font-size: 20px;
      max-width: 600px;
      margin: 0 auto;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    /* Services Section */
    .services {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 60px 40px;
    }

    .service-card {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .service-card img {
      width: 100%;
      border-radius: 12px;
      margin-bottom: 15px;
    }

    .service-card h3 {
      color: #166f3a;
      margin-bottom: 10px;
    }

    /* Footer */
    footer {
      background: #166f3a;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <header>
    <div class="logo">PsytechCare</div>
    <nav>
      <a href="#">Home</a>
      <a href="#">Services</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
    </nav>
    <form method="POST" action="logout.php">
      <button class="logout-btn" type="submit">Sign Out</button>
    </form>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <h1>Your Mental Health <span style="color: green;">Matters</span></h1>
    <p>PsyTechCare provides 24/7 AI Powered mental health support, profetional resources, and a safe Community design
      specially for university students.</p>
  </section>
  <div class="aisupport">
    <!-- AI Support Button -->
    <button class="ai-support-btn" onclick="toggleChat()">💬 AI Support</button>

    <!-- Chat Popup -->
    <div class="chat-popup" id="chatBox">
      <div class="chat-header">
        <span>AI Support</span>
        <button onclick="toggleChat()">✖</button>
      </div>
      <div class="chat-body" id="chatBody">
        <p><b>AI:</b> Hi! How can I help you today?</p>
      </div>
      <div class="chat-footer">
        <input type="text" id="chatInput" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
      </div>
    </div>

    <style>
      /* Floating AI Support Button */
      .ai-support-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #166f3a;
        color: white;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      }

      .ai-support-btn:hover {
        background: #125c30;
      }

      /* Chat Popup */
      .chat-popup {
        display: none;
        flex-direction: column;
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 300px;
        height: 400px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
      }

      .chat-header {
        background: #166f3a;
        color: white;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .chat-body {
        flex: 1;
        padding: 10px;
        overflow-y: auto;
        font-size: 14px;
      }

      .chat-footer {
        display: flex;
        border-top: 1px solid #ccc;
      }

      .chat-footer input {
        flex: 1;
        border: none;
        padding: 10px;
        outline: none;
        font-size: 14px;
      }

      .chat-footer button {
        background: #166f3a;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
      }

      /* Global Reset */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: Arial, sans-serif;
        background: #f7fdf9;
        color: #333;
        line-height: 1.6;
      }

      /* Navbar */
      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
        flex-wrap: wrap;
      }

      .logo {
        font-size: 22px;
        font-weight: bold;
        color: #166f3a;
      }

      nav {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
      }

      nav a {
        text-decoration: none;
        color: #166f3a;
        font-weight: 600;
      }

      .logout-btn {
        background: #166f3a;
        color: #fff;
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        margin-top: 5px;
      }

      /* Hero Section */
      .hero {
        background: url("1000046064.jpg") no-repeat center/cover;
        color: white;
        text-align: center;
        padding: 80px 20px;
      }

      .hero h1 {
        font-size: 36px;
        margin-bottom: 15px;
      }

      .hero p {
        font-size: 18px;
        max-width: 600px;
        margin: 0 auto;
      }

      /* Services Section */
      .services {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 40px 20px;
      }

      .service-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
      }

      .service-card img {
        width: 100%;
        border-radius: 12px;
        margin-bottom: 10px;
      }

      .service-card h3 {
        color: #166f3a;
        margin-bottom: 8px;
      }

      /* Footer */
      footer {
        background: #166f3a;
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: 30px;
      }

      /* Chat Button */
      #chatBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #166f3a;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        cursor: pointer;
        font-size: 22px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      }

      /* Chat Box */
      #chatBox {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 320px;
        max-height: 400px;
        display: none;
        flex-direction: column;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        overflow: hidden;
      }

      #chatHeader {
        background: #166f3a;
        color: #fff;
        padding: 10px;
        font-weight: bold;
      }

      #chatBody {
        padding: 10px;
        flex: 1;
        overflow-y: auto;
      }

      #chatInputBox {
        display: flex;
        border-top: 1px solid #ccc;
      }

      #chatInput {
        flex: 1;
        padding: 10px;
        border: none;
      }

      #chatSend {
        padding: 10px;
        border: none;
        background: #166f3a;
        color: #fff;
        cursor: pointer;
      }

      /* Forms (Login / Signup) */
      .form-container {
        max-width: 400px;
        margin: 60px auto;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #166f3a;
      }

      .form-container input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
      }

      .form-container button {
        width: 100%;
        padding: 12px;
        background: #166f3a;
        border: none;
        border-radius: 6px;
        color: white;
        font-weight: bold;
        cursor: pointer;
      }

      /* ✅ Responsive Design */
      @media (max-width: 768px) {
        .hero h1 {
          font-size: 26px;
        }

        .hero p {
          font-size: 16px;
        }

        nav {
          flex-direction: column;
          gap: 10px;
          margin-top: 10px;
        }

        #chatBox {
          width: 90%;
          right: 5%;
        }

        .form-container {
          margin: 40px 15px;
          padding: 20px;
        }
      }
    </style>

    <script>
      function toggleChat() {
        const chatBox = document.getElementById("chatBox");
        chatBox.style.display = (chatBox.style.display === "flex") ? "none" : "flex";
      }

      function sendMessage() {
        const input = document.getElementById("chatInput");
        const chatBody = document.getElementById("chatBody");

        if (input.value.trim() !== "") {
          // Show user message
          chatBody.innerHTML += "<p><b>You:</b> " + input.value + "</p>";
          chatBody.scrollTop = chatBody.scrollHeight;

          // Fake AI responses
          let replies = [
            "I'm here to help! 😊",
            "Can you tell me more about that?",
            "That sounds interesting!",
            "Let me think about it...",
            "You're doing great, keep going!"
          ];
          let reply = replies[Math.floor(Math.random() * replies.length)];

          chatBody.innerHTML += "<p><b>AI:</b> " + reply + "</p>";
          chatBody.scrollTop = chatBody.scrollHeight;

          input.value = "";
        }
      }
    </script>


  </div>

  <!-- Services Section -->
  <section class="services">
    <div class="service-card">
      <img src="1000046065.jpg" alt="Service 1">
      <h3>Therapy Sessions</h3>
      <p>Connect with professionals online or offline to improve your wellbeing.</p>
    </div>
    <div class="service-card">
      <img src="1000046067.jpg" alt="Service 2">
      <h3>Self-Care Tools</h3>
      <p>Track mood, habits, and daily progress with guided exercises.</p>
    </div>
    <div class="service-card">
      <img src="1000046069.jpg" alt="Service 3">
      <h3>Community Support</h3>
      <p>Join a safe space where you can share and support others.</p>
    </div>
    <div class="service-card">
      <img src="1000046070.jpg" alt="Service 4">
      <h3>Expert Articles</h3>
      <p>Read helpful guides and blogs written by mental health experts.</p>
    </div>
    <div class="service-card">
      <img src="1000046071.jpg" alt="Service 5">
      <h3>Workshops</h3>
      <p>Participate in interactive workshops on mindfulness and growth.</p>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 PsytechCare. All Rights Reserved.</p>
  </footer>

</body>

</html>