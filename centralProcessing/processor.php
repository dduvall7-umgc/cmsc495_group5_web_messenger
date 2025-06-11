<?php
// ==============================
// MESSAGE PROCESSING LOGIC
// ==============================

if (isset($_POST['userMessage'])) {
    // Extract user message and file names from POST data
    $userMessage = $_POST['userMessage'];
    $fileName = $_POST['fileName'];
    $recordName = $_POST['recordName'];

    // Append message to the designated file
    file_put_contents('../storageFiles/'.$fileName, $userMessage, FILE_APPEND);

    // Optional: Delete temporary file if requested
    $deleteMe = $_POST['deleteMe'];
    unlink($deleteMe); // delete the files to end session

    // Log what was deleted (for debugging)
    echo $deleteMe . " <<<<<<<<<<<<";
  
}

// ==============================
// HTML TEMPLATE GENERATION
// This generates a new HTML+PHP file dynamically.
// ==============================

// Dynamic variables for use in the template
$contentFile = '$content';
$server = '$_SERVER';
$fileDirectory = '$filePath';
$bracket = '[';

// Template string for new chat interface (embedded PHP and HTML)
$generateMessageSystem = "<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1.0' />
  <title>Direct Messaging Service</title>
  <link rel='stylesheet' href='../CSS/style.css' />
</head>

<body>

  <header id='userColorNameId' class='userColorNameClass'>Direct Messaging Service</header>
  <p id='messagesContainerTwo' class='messagesContainerTwo'></p>

  <div class='dialog-backdrop' id='dialog'>
    <div class='dialog-box'></div>
  </div>

  <!-- Chat Loader -->
  <form method='post'>
    <button class='new-chat-btn' id='loadForm' type='submit'>Load Chat</button>
  </form>

  <div class='app-container'>
    <aside class='sidebar'>

      <!-- Chat name input -->
      <input type='text' id='chatName' placeholder='Chat Name' />
      <p>-</p>
      <button class='new-chat-btn' id='newChat' onclick='createNewChat()'>+ New Chat</button>

      <form id='colorForm' class='new-chat-btn' >
        <p>Change Font Color</p> <br>
        <label><input type='radio' name='color' value='blue'> Blue</label><br>
        <label><input type='radio' name='color' value='orange'> Orange</label><br>
        <label><input type='radio' name='color' value='green'> Green</label><br>
        <label><input type='radio' name='color' value='red'> Red</label><br>
        <label><input type='radio' name='color' value='black'> Black</label><br>
        <label><input type='radio' name='color' value='darkmagenta'> Dark Magenta</label><br>
        <label><input type='radio' name='color' value='dodgerblue'> Dodger Blue</label><br>
      </form>

      <!-- Chat list area -->
      <div class='chat-list' id='chatList'>
        <div class='empty-state' id='noChats'>To remove all data, End the session by clicking the button below.</div>
      </div>

      <!-- End session / delete chat form -->
      <form action='../centralProcessing/deleteChat.php' method='post'>
        <label for='filename'>Session Data:</label>
        <input type='text' id='filename' name='filename' required disabled value='$fileName' placeholder='Set'>
        <input type='text' id='filenameDirect' name='filenameDirect' required disabled value='$recordName' placeholder='Set'>
        <button onclick='deleteChatName()' type='submit'>End Session</button>
      </form>

    </aside>

    <!-- Main chat area -->
    <section class='chat-area'>
      <div class='messages-container' id='messagesContainer'>
        <div class='empty-state'>Select a chat to start messaging.</div>
      </div>

      <!-- Message input and send -->
      <input type='text' id='messageInput' placeholder='Message...' />
      <button type='submit' onclick='sendMessage()'>Send</button>
    </section>
  </div>

  <!-- JavaScript/centralProcessing for chat interactivity -->
  <script src='../centralProcessing/script.js'></script>

  <script>
    var messagesContainer = document.getElementById('messagesContainer');
    document.getElementById('newChat').disabled = true;

    // Clear chat session (localStorage)
    function deleteChatName() {
      localStorage.clear();
      document.getElementById('filename').disabled = false;
      document.getElementById('filenameDirect').disabled = false;
    }

    // Set localStorage to match server chat name on page load
    window.onload = function() {
      getChatNameFromServer();
    };

    // Pull chat name from filename (without .php extension)
    function getChatNameFromServer() {
      var sendChatName = '$fileName';
      let nameWithoutExt = sendChatName.replace('.php', '');
      localStorage.setItem('chatName', nameWithoutExt);
    }

    // Auto-refresh chat by polling every 2 seconds
    let pollingInterval;

    document.getElementById('loadForm').addEventListener('click', function(e) {
      e.preventDefault(); // Prevent default form reload

      // Repeatedly fetch chat content from server
      pollingInterval = setInterval(function() {
        fetch('../storageFiles/$fileName')
          .then(response => response.text())
          .then(data => {
            messagesContainer.innerHTML = data;
          });
      }, 2000);
    });
    
    
    
    
    
    
    
  </script>

</body>
</html>";

// ==============================
// OUTPUT GENERATED CHAT PAGE
// ==============================

// Save the dynamically generated HTML+PHP content to a file
file_put_contents('../generatedInterface/'.$recordName, $generateMessageSystem);
?>
