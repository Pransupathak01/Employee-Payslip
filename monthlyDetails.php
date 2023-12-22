<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Employee";
    try {
        $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $con->prepare("SELECT * FROM monthly_details");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);


        echo "<table>
                <tr>
                <th> </th>
                </tr>
                </table>
                <table>";
        foreach ($res as $row) {
            echo "  <tr>";
            echo "    <td>Total Working Days </td>";
            echo "   <td>" . $row['total_working_days'] . " </td>";
            echo "    <td>Paid Days</td>";
            echo "    <td>" . $row['paid_days'] . " </td>";
            echo "</tr>
            <tr>
            <td>LOB Days</td>";
            echo "    <td>" . $row['lob_days'] . " </td>";
            echo "    <td>Leaves Taken</td>";
            echo "    <td>" . $row['leaves_taken'] . " </td>";
            echo " </tr>";
        }
        echo "</table>
        <table>
                <tr>
                    <th>  </th>
                </tr>
                </table>";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $con = null;
    ?>

</body>
<html>