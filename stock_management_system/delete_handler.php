<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sms";

    // รับค่า id ของสินค้าที่ต้องการลบ
    $id = $_POST['id'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("การเชื่อมต่อกับฐานข้อมูลล้มเหลว (ติดต่อผู้ดูแลระบบ)" . $conn->connect_error);
    }

    // ลบข้อมูลสินค้าจากตาราง product
    $sql = "DELETE FROM product WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "ลบข้อมูลสินค้าเรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . $conn->error;
    }

    $conn->close();

    // Redirect กลับไปยังหน้า delete_product.php
    header("Location: delete_product.php");
    exit;
} else {
    // หากไม่ได้ส่งค่ามาผ่าน POST method ให้ redirect กลับไปยังหน้า delete_product.php
    header("Location: delete_product.php");
    exit;
}
?>
