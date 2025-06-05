<!DOCTYPE html>
<html lang="en">
<?php
// ==============================
// PHP BACKEND: READ CHAT FILE
// ==============================

$content = ""; // Initialize content holder

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Function to safely read content from a file
    function readFileContent($filePath) {
        if (!file_exists($filePath)) {
            return "File does not exist.";
        }

        $content = file_get_contents($filePath);
        if ($content === false) {
            return "Failed to read file.";
        }

        // Optional: Uncomment below to prevent XSS by escaping HTML
        // return htmlspecialchars($content);

        return $content;
    }

    // Load chat content from file (Test.php)
    $content = readFileContent("Test.php");
}
?>
  
<head>
  <!-- ==========================
       META & STYLES
  ========================== -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Direct Messaging Service</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- ==========================
       HEADER
  ========================== -->
  <header  id="userColorNameId" class="userColorNameClass">Direct Messaging Service</header>

  <!-- ==========================
       DIALOG BOX (for future use)
  ========================== -->
  <div class="dialog-backdrop" id="dialog">
    <div class="dialog-box"></div>
  </div>

  <!-- ==========================
       LOAD CHAT BUTTON
  ========================== -->
  <h1>Load Chat</h1>
  <form method="post">
    <button class="new-chat-btn" id="loadForm" type="submit">Load Chat</button>
  </form>

  <!-- ==========================
       MAIN APP LAYOUT
  ========================== -->
  <div class="app-container">
    <!-- ========== SIDEBAR ========= -->
    <aside class="sidebar">
      <!-- Input: Chat name -->
      <input type="text" id="chatName" placeholder="Chat Name" />
      
      <!--up arrows to direct the user to the proper location-->
      <p>&#8593;&#8593;&#8593;&#8593;</p>
      
      <!-- Button: Enter Chat Name -->
      <button class="new-chat-btn" id="newChat" onclick="createNewChat()">+ Enter Chat Name</button>

      <!-- Chat list or empty state -->
      <div class="chat-list" id="chatList">
        <div class="empty-state" id="noChats">
          To remove all data, end the session by clicking the button below.
        </div>
      </div>

      

      
      
      <!-- Form: End session (clear server-side data) -->
      <form action="deleteChat.php" method="post">
        <label for="filename">Session Data</label>
        <input type="text" id="filename" name="filename" required disabled value="Online" placeholder="Set">
        <input type="text" id="filenameDirect" name="filenameDirect" required disabled value="Online" placeholder="Set">
        <button onclick="deleteChatName()" type="submit">End Session</button>
      </form>
    </aside>

    <!-- ========== CHAT AREA ========= -->
    <section class="chat-area">
      <!-- Chat messages display -->
      <div class="messages-container" id="messagesContainerTwo">
        <?php if ($content): ?>
          <h2>File Content:</h2>
          <p><?php echo $content; ?></p>
        <?php endif; ?>

        <!-- Default empty-state instructions -->
        <div class="empty-state">
          <h1>To begin</h1>
          <ol>
            <li>Name your chat</li>
            <li>Click &nbsp; + Enter Chat Name &nbsp; Buttton</li>
            <li>Load the chat</li>
            <li>Send a message</li>
          </ol>
        </div>
      </div>

      <!-- Message input and send button -->
      <input type="text" id="messageInput" placeholder="Message..." />
      <button type="submit" onclick="sendMessage()">Send</button>
    </section>
  </div>

  <!-- ==========================
       JAVASCRIPT INCLUDES & LOGIC
  ========================== -->
  <script src="script.js"></script>
  
</body>
</html>
