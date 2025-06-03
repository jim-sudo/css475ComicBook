<?php
/**
 * Created by PhpStorm.
 * User: MKochanski
 * Date: 7/24/2018
 * Time: 3:07 PM
 */
require_once 'config.inc.php';
?>
<html>
<head>
    <title>Sample PHP Database Program</title>
    <link rel="stylesheet" href="base.css">
</head>
<body>
<?php require_once 'header.inc.php'; ?>
<div>

<h2>Product Catalog</h2>

<!-- Filter Form -->
<form method="GET" action="list_products.php">
    <label for="title">Filter by Title:</label>
    <input type="text" name="title" id="title" placeholder="e.g., Batman">
    <input type="submit" value="Filter">
</form>

<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Filter input
$titleFilter = isset($_GET['title']) ? "%" . $conn->real_escape_string($_GET['title']) . "%" : "%";

// Prepare SQL
$sql = "SELECT IssueID, title, Release_date FROM comic_book_issue WHERE title LIKE ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Failed to prepare statement.";
} else {
    // Bind and execute
    $stmt->bind_param("s", $titleFilter);
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($IssueID, $title, $Release_date);

    // Fetch and display
    while ($stmt->fetch()) {
        echo "<p>" . $IssueID . ": " . $title . " — created in: " . $Release_date . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

</div>
</body>
</html>