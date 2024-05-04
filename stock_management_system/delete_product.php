<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
</head>
<body>
    <h2>Delete Product</h2>
    <p style="color: red;">หากกดลบแล้ว สินค้าจะถูกลบทันที ไม่สามารถกู้คืนได้</p>
    <p style="color: red;">ควรตัดสินใจลบอย่างมีสติ และตรวจสอบให้ดีทุกครั้งก่อนกดลบรายการสินค้า!<p>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sms";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("การเชื่อมต่อกับฐานข้อมูลล้มเหลว (ติดต่อผู้ดูแลระบบ)" . $conn->connect_error);
    }

    $sql = "SELECT id, name_product FROM product";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name Product</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name_product"] . "</td><td><form action='delete_handler.php' method='POST'><input type='hidden' name='id' value='" . $row["id"] . "'><input type='submit' value='Delete'></form></td></tr>";
        }
        echo "</table>";
    } else {
        echo "ไม่พบสินค้า";
    }

    $conn->close();
    ?>
    <a href="index.php">Go Back.</a>
</body>
</html>
