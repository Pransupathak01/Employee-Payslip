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

        $sql = $con->prepare("SELECT * FROM employee_payinfo");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo"<table>
        <tr>
            <th>
                <b>Earning</b>
            </th>
            <th>
                <b>Deductions</b>
            </th>
        </tr>
        </table>
        <table>";
        foreach ($res as $row) {
            echo "<tr>
            <td>Basic Wage</td>";
            echo "<td>Rs." . $row['basic_wage'] . "</td>";
            echo "    <td>EPF</td>";
            echo "    <td>Rs." . $row['epf'] . "</td>";
            echo "</tr>
        <tr>
            <td>HRA</td>";
            echo "    <td>Rs." . $row['hra'] . "</td>";
            echo "    <td>Professional Tax</td>";
            echo "    <td>Rs." . $row['profession_tax'] . " </td>";
            echo "</tr>
        <tr>
            <td>Conveyance Allowances</td>";
            echo " <td>Rs." . $row['conveyance_allowances'] . "</td>";
            echo "<td>TDS </td>";
            echo "<td>Rs." . $row['tds'] . "</td>";
            echo "</tr>
        <tr>
            <td>Medical Allowances </td>";
            echo "<td>Rs." . $row['medical_allowances'] . " </td>";
            echo "<td>ESI/Health Insurance</td>";
            echo "<td>Rs." . $row['esi/health_insurance'] . "</td>";
            echo "</tr>
        <tr>
            <td>Other Allowances</td>";
            echo "<td>Rs." . $row['other_allowances'] . "</td>";
            echo "<td> </td>
            <td> </td>
        </tr>";
            echo "<tr>
            <td>
                <b> Total Earning </b>
            </td>";
            echo "<td><b>Rs." . $row['total_earning'] . "</b></td>";
            echo "<td><b> Total Deductions </b></td>";
            echo "<td><b>Rs." . $row['total_deductions'] . "</b></td>";
            echo " </tr>";

            echo "<tr>
            <td class='netsalary'>
                <b> Net Salary</b>
            </td>";
            echo " <td>
                <b> Rs." . $row['net_salary'] . "</b>
            </td>
        </tr>
        </table>";
        }
        
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $con = null;
    ?>

</body>
<html>