<?php
    //error_reporting(0);
    $servername = "db403-mysql";
    $database = "northwind";
    $username = "root";
    $password = "P@ssw0rd";

    try {
        //ใช้ try/catch เพื่อใช้เก็บข้อความจาก server
        $conn = new mysqli($servername, $username, $password, $database);
    }
    catch (Exception $e) {
        //echo $e -> getMessage(); //หากต้องการ Get error message ให้เอา Comment ออก
        die("Connection failed");
    }
    echo "Connected successfully";
    
    //$conn = new mysqli($servername, $username, $password, $database); // ใช้ตัวแปร $conn เพื่อไปต่อเข้า database instance
    //if (!$conn) {
    //    die("Connection failed"); // ถ้าเชื่อมต่อไม่ได้ให้ยุติการคำสั่งลำดับถัดๆไปอัตโนมัติ
    //}
    //echo "Connected successfully"; // สั่งให้ echo ข้อความออกมาหากเชื่อมต่อได้
    //$conn->close(); // สั่ง close เพื่อคืน connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect to MySQL</title>
</head>
<body>
    <?php
        $sql = "SELECT * FROM categories";
        try {
            $result = $conn->query($sql);
        }
        catch (Exception $e) {
            //echo $e->getMessage(); //จะ Debug error ค่อยลบ Comment
            echo 'Somthing went wrong.';
            //echo "<table>";
            //while($row = $result->fetch_assoc()) {
            //    echo "<tr>";
            //    echo "<td>{$row['CategoryID']}</td>";
            //    echo "<td>{$row['CategoryName']}</td>";
            //    echo "</tr>";
            //}
            //echo "</table>";
        }
        //$result = $conn->query($sql); //ใช้ตัวแปรเป็น result เพื่อใช้ส่งคำสั่งไปยัง Database Server และควรสั่งใน try/catch
        //echo "<table>";
        //while($row = $result->fetch_assoc()) {
        //    echo "<tr>";
        //    echo "<td>{$row['CategoryID']}</td>";
        //    echo "<td>{$row['CategoryName']}</td>";
        //    echo "</tr>";
        //}
        //echo "</table>";
        //$conn->close(); // Close DB connection
    ?>
    <ol> <!-- Order list-->
        <li> <!-- list item -->
            <p>แสดงจำนวนวันเฉลี่ยที่ใช้ในการขนส่งสินค้านับจากวันที่มีการสั่งสินค้าถึงวันที่ส่งสินค้า (เศษของวันนับเป็น 1 วัน) ของแต่ละประเทศ เรียงลำดับจากมากไปหาน้อย</p>
            <table>
                <tr><th>ShipCountry</th><th>AvgShippedDays</th></tr>
                <?php
                $sql = 'SELECT CEILING(AVG(DATEDIFF(ShippedDate, OrderDate))) AS AvgShippedDays, ShipCountry
                FROM orders
                GROUP BY ShipCountry
                ORDER BY AvgShippedDays DESC';
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo "<td>{$row['ShipCountry']}</td>";
                    echo "<td>{$row['AvgShippedDays']}</td>";
                    echo '</tr>';
                }
                ?>;
            </table>
        </li>
        <li>
            <p>แสดงจำนวนรายการสั่งซื้อของแต่ละเดือน ในปี 1995</p>
            <table>
                <tr><th>Month no. in 1995</th><th>Total Orders</th></tr>
                <?php
                $sql = 'SELECT MONTH(OrderDate) AS `Month no. in 1995`, COUNT(*) AS `Total Orders`
                FROM orders
                WHERE YEAR(OrderDate) = 1995
                GROUP BY `Month no. in 1995`';
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo "<td>{$row['Month no. in 1995']}</td>";
                    echo "<td>{$row['Total Orders']}</td>";
                    echo '</tr>';
                }
                ?>;
            </table>
        </li>
        <li>
            <p>ค้นหาว่าประเทศใดมีลูกค้ามากที่สุด</p>
            <table>
            <tr><th>TotalCustomers</th><th>Country</th></tr>
                <?php
                $sql = 'SELECT COUNT(*) TotalCustomers, Country
                FROM customers
                GROUP BY Country
                ORDER BY TotalCustomers DESC
                LIMIT 10;';
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo "<td>{$row['TotalCustomers']}</td>";
                    echo "<td>{$row['Country']}</td>";
                    echo '</tr>';
                }
                ?>
                <?php
                    //$conn->close(); // Close DB connection
                ?>;
            </table>
        </li>
        <li>
            <p>หายอดสั่งซื้อสินค้าของแต่ละหมวด แยกตามประเทศของลูกค้า</p>
            <table>
            <tr><th>CategoryName</th><th>Country</th><th>TotalSaleOrders</th></tr>
                <?php
                $sql = 'SELECT G.CategoryName, C.Country, COUNT(*) TotalSaleOrders
                FROM categories G
                    JOIN products P ON G.CategoryID = P.CategoryID
                    JOIN `order details` D ON P.ProductID = D.ProductID
                    JOIN orders O ON D.OrderID = O.OrderID
                    JOIN customers C ON O.CustomerID = C.CustomerID
                GROUP BY G.CategoryName, C.Country;';
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo "<td>{$row['CategoryName']}</td>";
                    echo "<td>{$row['Country']}</td>";
                    echo "<td>{$row['TotalSaleOrders']}</td>";
                    echo '</tr>';
                }
                ?>
                <?php
                    $conn->close(); // Close DB connection
                ?>;
            </table>
        </li>
    </ol>
</body>
</html>