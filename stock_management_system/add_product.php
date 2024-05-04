<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required><br><br>
        <label for="name_product">Name Product:</label>
        <input type="text" id="name_product" name="name_product" required><br><br>
        <input type="submit" value="Submit">
        <a href="index.php">Go back.</a>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sms";
    
        // รับค่าที่ส่งมาจากฟอร์ม
        $id = $_POST['id'];
        $name_product = $_POST['name_product'];
    
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("การเชื่อมต่อกับฐานข้อมูลล้มเหลว (ติดต่อผู้ดูแลระบบ)" . $conn->connect_error);
        }
    
        // เช็คว่า ID ที่จะใส่ลงในฐานข้อมูลมีอยู่แล้วหรือไม่
        $check_sql = "SELECT id FROM product WHERE id = '$id'";
        $check_result = $conn->query($check_sql);
        if ($check_result->num_rows > 0) {
            echo "ID นี้มีอยู่แล้วในฐานข้อมูล";
        } else {
            // ถ้ายังไม่มีให้ทำการ INSERT ข้อมูล
            $sql = "INSERT INTO product (id, name_product) VALUES ('$id', '$name_product')";
    
            if ($conn->query($sql) === TRUE) {
                echo "บันทึกข้อมูลสำเร็จ";
            } else {
                echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
            }
        }
    
        $conn->close();
    }
    
    ?>
</body>
</html>
