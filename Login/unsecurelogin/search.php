<?php
$conn = new mysqli("localhost", "root", "", "app_db");

// Get user input from the search box
$search = $_GET['search'];

// 🚨 Vulnerable SQL (unsafe concatenation)
$sql = "SELECT name FROM products WHERE name LIKE '%$search%'";

echo "<pre>Executed Query:\n$sql</pre>";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<h3>Results:</h3><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['name'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No results found.</p>";
}
?>
