<?php
session_start();

if (!isset($_SESSION['registrations'])) {
    $_SESSION['registrations'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $club = trim($_POST['club'] ?? '');
    $comments = trim($_POST['comments'] ?? '');
    $errors = [];

    if (!$name) $errors[] = "Name is required.";
    if (!$email) $errors[] = "Email is required.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (!$club) $errors[] = "Please select a club.";

    echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Registration Result</title>
          <link rel='stylesheet' href='styles.css'></head><body>";

    if ($errors) {
        echo "<div class='result error'>";
        echo "<h1>Form Errors</h1><ul>";
        foreach ($errors as $e) echo "<li>$e</li>";
        echo "</ul><a href='index.html' class='back-btn'>Back to form</a>";
        echo "</div>";
    } else {
        $_SESSION['registrations'][] = [
            'name' => $name,
            'email' => $email,
            'club' => $club,
            'comments' => $comments
        ];

        echo "<div class='result success'>";
        echo "<h1>Registration Successful!</h1>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Club:</strong> $club</p>";
        if ($comments) echo "<p><strong>Comments:</strong> $comments</p>";

        echo "<h2>All Registrations:</h2><ul>";
        foreach ($_SESSION['registrations'] as $r) {
            echo "<li>{$r['name']} | {$r['email']} | {$r['club']}";
            if (!empty($r['comments'])) echo " | {$r['comments']}";
            echo "</li>";
        }
        echo "</ul><a href='index.html' class='back-btn'>Register another</a>";
        echo "</div>";
    }

    echo "</body></html>";
} else {
    header("Location: index.html");
    exit();
}
?>