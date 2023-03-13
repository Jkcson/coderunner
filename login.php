<?php
    // Get the posted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Open the passwords file for reading
    $file = fopen("passwords.txt", "r");

    // Read the file line by line
    while(!feof($file)) {
        // Get the next line
        $line = fgets($file);

        // Split the line into username and password
        $credentials = explode(':', $line);
        $stored_username = trim($credentials[0]);
        $stored_password = trim($credentials[1]);

        // Check if the entered credentials match the stored ones
        if($username === $stored_username && $password === $stored_password) {
            // Redirect to the homepage if the credentials are correct
            header("Location: homepage.html");
            exit();
        }
    }

    // If the loop finishes without finding a matching username and password, display an error message
    echo "Invalid username or password";
?>
