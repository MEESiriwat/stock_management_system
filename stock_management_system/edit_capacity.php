<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("การเชื่อมต่อกับฐานข้อมูลล้มเหลว (ติดต่อผู้ดูแลระบบ)" . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่งค่า ID มาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ค้นหาข้อมูลของสินค้าด้วย ID
    $sql = "SELECT * FROM product WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name_product'];
        $capacity = $row['capacity'];
    } else {
        echo "ไม่พบสินค้าที่ต้องการแก้ไข";
        exit();
    }
} else {
    echo "ไม่พบ ID สำหรับการแก้ไข";
    exit();
}

// หากมีการส่งข้อมูลมาจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_capacity = $_POST['new_capacity'];

    // อัปเดต capacity ในฐานข้อมูล
    $update_sql = "UPDATE product SET capacity = $new_capacity WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "อัปเดตข้อมูลสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Capacity</title>
</head>
<body>
    <h2>Edit Capacity</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>" method="POST">
        <label for="capacity">Current Capacity:</label>
        <input type="text" id="capacity" name="capacity" value="<?php echo $capacity; ?>" readonly><br><br>
        <label for="new_capacity">New Capacity:</label>
        <input type="text" id="new_capacity" name="new_capacity" required><br><br>
        <input type="submit" value="Update Capacity">
        <a href="index.php">Go back.</a>
    </form>
</body>
</html>
