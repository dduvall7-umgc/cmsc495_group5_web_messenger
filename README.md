# Direct Messaging Service

## Overview
The Direct Messaging Service is a web-based application that allows users to create, join, and participate in chat sessions. Users can name their chats, send messages with customizable font colors, share chat links, and end sessions to clear data. The application uses PHP for backend processing, JavaScript for frontend interactivity, and CSS for styling.

## Features
- **Dynamic Chat Creation**: Users can create named chat sessions and generate unique chat links.
- **Real-Time Messaging**: Messages are saved to files and displayed in a chat interface, with polling for updates every 2 seconds.
- **Customizable UI**: Users can select font colors (e.g., blue, orange, green) for their messages.
- **Session Management**: Users can end sessions, deleting associated chat data.
- **Responsive Design**: The interface is styled for usability across devices using a flexible layout.

## Tech Stack
- **Backend**: PHP (handles message processing, file storage, and dynamic HTML generation)
- **Frontend**: JavaScript (manages UI interactions, localStorage, and AJAX requests)
- **Styling**: CSS (responsive layout with a sidebar and chat area)
- **Storage**: File-based storage for chat messages (in `storageFiles/` and `generatedInterface/` directories)

## Prerequisites
- A web server with PHP support (e.g., Apache, Nginx)
- PHP 7.4 or higher
- A modern web browser (e.g., Chrome, Firefox)
- Write permissions for the `storageFiles/` and `generatedInterface/` directories

## Installation




## Usage
1. **Starting a Chat**:
   - On the `index.php` page, enter a chat name in the provided input field.
   - Click the “+ Enter Chat Name” button to create a new chat.
   - Click “Load Chat” to initialize the chat session.
2. **Sending Messages**:
   - Type your message in the input field and click “Send”.
   - Messages are saved with the selected font color and displayed in the chat area.
3. **Sharing Chats**:
   - After sending a message, a shareable link is generated (e.g., `http://127.0.0.1/Capstone/<chatName>Direct.php`).
   - Copy and share this link to allow others to join the chat.
4. **Customizing Font Color**:
   - Select a color from the sidebar’s radio buttons (e.g., Blue, Orange, Green).
   - The selected color applies to your chat name in messages.
5. **Ending a Session**:
   - Click “End Session” in the sidebar to delete the chat data and clear localStorage.
   - This removes the associated files from `storageFiles/` and `generatedInterface/`.

## Project Structure
Main/
├── centralProcessing/
│   ├── processor.php        # Handles message storage and dynamic chat page generation
│   ├── deleteChat.php       # Deletes chat session files
│   └── script.js            # Frontend logic for chat interactions
├── CSS/
│   └── style.css            # Styles for the application
├── generatedInterface/       # Stores dynamically generated chat pages
├── storageFiles/            # Stores chat message data
├── index.php                # Main entry point for the application
└── index_Script.js          # Frontend logic for index.php

## Key Files
- **`processor.php`**: Processes user messages, appends them to storage files, and generates chat interface files dynamically.
- **`deleteChat.php`**: Handles session deletion by removing chat files and redirecting to `index.php`.
- **`script.js` / `index_Script.js`**: Manages chat creation, message sending, link generation, and font color selection.
- **`style.css`**: Defines the responsive layout and color scheme for the UI.
- **`index.php`**: The main interface for starting or joining chats.

## Troubleshooting
- **“Failed to end session” Error**: Check if `storageFiles/` and `generatedInterface/` have proper write permissions.
- **Messages Not Displaying**: Ensure the `fetch` request in `script.js` points to the correct `storageFiles/` path.
- **Chat Link Not Working**: Verify that the generated chat file exists in `generatedInterface/`.