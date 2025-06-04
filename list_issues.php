<?php
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

<h2>Issues</h2>

<!-- Filter Form -->
<form method="GET" action="list_products.php">
    <label for="title">Filter by Title:</label>
    <input type="text" name="title" id="title" placeholder="e.g., Batman">

    <label for="after_date">Released After:</label>
    <input type="date" name="after_date" id="after_date">

    <label for="issue_number">Issue Number:</label>
    <input type="number" name="issue_number" id="issue_number" placeholder="e.g., 100">

    <label for="issue_operator">Filter Type:</label>
    <select name="issue_operator" id="issue_operator">
        <option value=">">Greater than</option>
        <option value="<">Less than</option>
        <option value="=">Equal to</option>
    </select>

    <input type="submit" value="Filter">
</form>

<?php
$conn = new mysqli($servername, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$titleFilter = isset($_GET['title']) ? "%" . $conn->real_escape_string($_GET['title']) . "%" : "%";
$dateFilter = isset($_GET['after_date']) && $_GET['after_date'] !== '' ? $_GET['after_date'] : null;
$issueNumber = isset($_GET['issue_number']) && is_numeric($_GET['issue_number']) ? (int)$_GET['issue_number'] : null;
$issueOperator = isset($_GET['issue_operator']) && in_array($_GET['issue_operator'], ['>', '<', '=']) ? $_GET['issue_operator'] : null;

$sql = "SELECT IssueID, title, Release_date FROM comic_book_issue WHERE title LIKE ?";
$params = ["s", &$titleFilter];

if ($dateFilter) {
    $sql .= " AND Release_date > ?";
    $params[0] .= "s";
    $params[] = &$dateFilter;
}

if ($issueNumber !== null && $issueOperator) {
    $sql .= " AND IssueID $issueOperator ?";
    $params[0] .= "i";
    $params[] = &$issueNumber;
}

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "<p style='color: red;'>Failed to prepare statement.</p>";
} else {
    call_user_func_array([$stmt, 'bind_param'], $params);
    $stmt->execute();
    $stmt->bind_result($IssueID, $title, $Release_date);

    $hasResults = false;
    while ($stmt->fetch()) {
        $hasResults = true;
        echo "<p>" . htmlspecialchars($IssueID) . ": " . htmlspecialchars($title) . " — created in: " . htmlspecialchars($Release_date) . "</p>";
    }

    if (!$hasResults) {
        echo "<p>No results found.</p>";
    }

    $stmt->close();
}

$conn->close();
?>

</div>
</body>
</html>
