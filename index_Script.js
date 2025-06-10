// ==============================
// GLOBAL VARIABLES
// ==============================
var newChat = document.getElementById("newChat");
var chatName = document.getElementById("chatName");
var messageInput = document.getElementById("messageInput");
var messagesContainer = document.getElementById("messagesContainer");
var messagesContainerTwo = document.getElementById("messagesContainerTwo");

//color scheme
var color = localStorage.getItem('fontColor');

// ==============================
// INITIAL SETUP & USER CHECK
// ==============================

// Check if a chat name is stored in localStorage
if (localStorage.getItem("chatName") === null) {
    // Set a default chat name and warn user
    localStorage.setItem("chatName", "-");
    alert("Do not share personal information");
} else {
    // Hide the chat name input if name already exists (to prevent renaming)
    chatName.style.display = "none";
}

// Retrieve chat name from storage
var getUserName = localStorage.getItem("chatName");
if (getUserName.length > 1) {
    newChat.innerHTML = getUserName;
    messageInput.placeholder = "Message By: " + getUserName;
    newChat.style.color = "yellow";
}

// ==============================
// CREATE NEW CHAT
// ==============================

function createNewChat() {
    // Use default chat name if input is empty
    if (chatName.value === "") {
        chatName.value = "Open Chat to <br> Anyone in the World";
    }

    // Update display and placeholder text
    newChat.innerHTML = chatName.value;
    messageInput.placeholder = "Message By: " + chatName.value;
    newChat.style.color = "yellow";

    // Save chat name to localStorage
    saveUserName(chatName.value);
}

// Save chat name to localStorage
function saveUserName(chatName) {
    localStorage.setItem("chatName", chatName);
}

// ==============================
// SEND MESSAGE
// ==============================

function sendMessage() {
    // Make a POST request to server (processor.php)
    fetch("centralProcessing/processor.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `userMessage=${encodeURIComponent(
            "<p id='userColorNameId' class="+color+"> ChatName: (" + getUserName + ") </p>"  + messageInput.value + "<br><br>" + "<?php $recordName = '" + getUserName + "'; ?>"
        )}&fileName=${encodeURIComponent(getUserName + ".php")}&recordName=${encodeURIComponent(getUserName + "Direct" + ".php")}`
    })
    .then(response => response.text()); // Handle response if needed

    // Only applies on index.php
    generateLink();
}

// ==============================
// UI INTERACTIONS
// ==============================

// Highlight message input field on focus
messageInput.addEventListener("focus", function () {
    messageInput.style.backgroundColor = "yellow";
});

// Reset background on blur
messageInput.addEventListener("blur", function () {
    messageInput.style.backgroundColor = "";
});

// ==============================
// SESSION CLEARING
// ==============================

function deleteChatName() {
    localStorage.clear(); // Clear stored chat data
    document.getElementById("filename").disabled = false;
    document.getElementById("filenameDirect").disabled = false;
    
    // Optionally: reload the page to reset state
    // location.reload();
}

// ==============================
// LINK GENERATION
// ==============================

function generateLink() {
    // Show a shareable link depending on deployment environment

    // === LOCAL TESTING ===\
    
    messagesContainerTwo.innerHTML = "<p> Copy and share this link </p><i>http://127.0.0.1/Capstone/" + 
        newChat.innerHTML + "Direct.php</i><br>" +
        "<a href='http://127.0.0.1/Capstone/generatedInterface/" + newChat.innerHTML + "Direct.php'>Access the chat here.</a> <br><br>";

    // === PRODUCTION ===
    //messagesContainerTwo.innerHTML = "<p> Copy and share this link </p><i>https://project.purposeseven.com/" +
    //    newChat.innerHTML + "Direct.php</i><br><br>" +
    //    "<a href='https://project.purposeseven.com/" +
    //    newChat.innerHTML + "Direct.php'>Access the chat here.</a>";
}

// ==============================
// USERS MESSAGE COLOR SCHEME
// ==============================

    const colorForm = document.getElementById('colorForm');
    const sampleText = document.getElementById('userColorNameId');
  
        // Add change event listener
    colorForm.addEventListener('change', (event) => {
      if (event.target.name === 'color') {
        const selectedColor = event.target.value;
        localStorage.setItem('fontColor', selectedColor);
      }
    });
    