<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Stock</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
        }

        /* Navigation Styles */
        nav {
            text-align: center;
            margin-bottom: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            background-color: #ddd;
        }

        nav .delete {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            background-color: #Ff0000;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        /* Footer Styles */
        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer p {
            margin-bottom: 10px;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            border-bottom: 1px solid #fff;
            transition: border-bottom 0.3s ease;
        }

        .footer a:hover {
            border-bottom: 1px solid transparent;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Manage Stock Product</h1>
        </header>

        <nav>
            <a href="index.php">Home</a>
            <a href="report.php">Report</a>
            <a href="add_product.php">Add Product</a>
            <a class="delete" href="delete_product.php">Delete Product</a>
        </nav>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Capacity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sms";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("การเชื่อมต่อฐานข้อมูลล้มเหลว" . $conn->connect_error);
                }

                $sql = "SELECT id, name_product, capacity FROM product";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name_product"] . "</td><td>" . $row["capacity"] . "</td><td><a href='edit_capacity.php?id=" . $row["id"] . "'>Edit Capacity</a></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <footer class="footer">
            <p>ระบบการจัดการ สินค้าเวอร์ชั่นที่ 0.0.1</p>
            <p>ติดต่อผู้ดูแลระบบ <a href="mailto:siriwat.soingam@intrachai.ac.th">siriwat.soingam@intrachai.ac.th</a> |
                โทร 0612573878</p>
        </footer>
    </div>
</body>

</html>