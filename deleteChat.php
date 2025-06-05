<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filename = basename($_POST["filename"]);  // Sanitize input
    $filePath = __DIR__ . '/' . $filename;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "File '$filename' deleted successfully.";
        } else {
            echo "Failed to delete '$filename'. Check permissions.";
        }
    } else {
        echo "File '$filename' does not exist.";
    }
} else {
    echo "Invalid request method.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filename = basename($_POST["filenameDirect"]);  // Sanitize input
    $filePath = __DIR__ . '/' . $filename;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "File '$filename' deleted successfully.";
        } else {
            echo "Failed to delete '$filename'. Check permissions.";
        }
    } else {
        echo "File '$filename' does not exist.";
    }
} else {
    echo "Invalid request method.";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="refresh" content="0; URL='index.php'" />
  <title>Redirecting...</title>
</head>
<body>
  <p>If you are not redirected automatically, <a href="index.php">click here</a>.</p>
</body>
</html>


