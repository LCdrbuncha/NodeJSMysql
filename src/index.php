<?php
$host = 'mysql';       
$db   = 'mydb';        
$user = 'myuser';      
$pass = 'mypassword';  

// เชื่อมต่อ MySQL ด้วย mysqli
$mysqli = new mysqli($host, $user, $pass, $db);

// ตรวจสอบการเชื่อมต่อ
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

// ตั้งค่า charset
$mysqli->set_charset("utf8mb4");

// ตรวจสอบการส่งฟอร์ม POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if (!empty($name) && !empty($email)) {
        // ใช้ prepared statement ป้องกัน SQL injection
        $stmt = $mysqli->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ss", $name, $email); // s = string
            if ($stmt->execute()) {
                echo "<p style='color:green;'>✅ User added successfully!</p>";
            } else {
                echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color:red;'>❌ Prepare failed: " . $mysqli->error . "</p>";
        }
    } else {
        echo "<p style='color:red;'⚠️ Name and Email are required!</p>";
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
        // ดึงข้อมูล users
        $result = $mysqli->query("SELECT id, name, email, created_at FROM users ORDER BY id DESC");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
            }
            $result->free();
        } else {
            echo "<tr><td colspan='4'>❌ Error fetching data: " . $mysqli->error . "</td></tr>";
        }

        // ปิดการเชื่อมต่อ
        $mysqli->close();
        ?>
    </table>
</body>
</html>
