<?php
$host = 'mysql';       
$db   = 'mydb';        
$user = 'myuser';      
$pass = 'mypassword';  
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if (!empty($name) && !empty($email)) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        try {
            $stmt->execute([$name, $email]);
            echo "<p style='color:green;'>✅ User added successfully!</p>";
        } catch (PDOException $e) {
            echo "<p style='color:red;'>❌ Error: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color:red;'>⚠️ Name and Email are required!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
</head>
<body>
    <h2>Add New User</h2>
    <form method="POST">
        <label>Name: <input type="text" name="name" required></label><br><br>
        <label>Email: <input type="email" name="email" required></label><br><br>
        <button type="submit">Add User</button>
    </form>

    <hr>

    <h2>User List</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Created At</th>
        </tr>
        <?php
        $stmt = $pdo->query("SELECT id, name, email, created_at FROM users ORDER BY id DESC");
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['created_at']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
