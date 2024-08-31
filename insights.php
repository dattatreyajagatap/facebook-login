<?php
session_start();

// Check if the user is logged in and session data exists
if (!isset($_SESSION['fb_access_token'])) {
    echo "User not logged in.";
    exit();
}

// Display user profile info
echo "<h1>Welcome, " . $_SESSION['user_name'] . "</h1>";
echo "<img src='" . $_SESSION['user_picture'] . "' alt='Profile Picture'>";

// Display pages managed by the user
echo "<h2>Your Pages:</h2>";
echo "<form method='POST' action='insights.php'>";
echo "<select name='page_id'>";
foreach ($_SESSION['pages'] as $page) {
    echo "<option value='" . $page['id'] . "'>" . $page['name'] . "</option>";
}
echo "</select>";
echo "<input type='submit' value='Get Insights'>";
echo "</form>";

// If a page is selected, show insights
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page_id = $_POST['page_id'];
    // Fetch and display insights (this is where you make the API call to get page insights)
    echo "<h3>Showing insights for page ID: $page_id</h3>";
}
