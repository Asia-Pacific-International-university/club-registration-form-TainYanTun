<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract POST data safely
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $club = htmlspecialchars($_POST['club'] ?? '');

    echo "<h1>Registration Confirmation</h1>";
    echo "<p>Name: <strong>$name</strong></p>";
    echo "<p>Email: <strong>$email</strong></p>";
    echo "<p>Club: <strong>$club</strong></p>";
    echo "<a href='index.html'>Go back</a>";
} else {
    echo "<p>Form not submitted properly.</p>";
}
?>
