<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>

    <style>
        table {
            justify-content: center;
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td,
        tr {
            border: 1px solid;
            padding: 3px 5px;
        }


        th,
        td {
            height: 25px;
            padding: 3px 5px;
            border: solid 1px;
        }

        .cname {
            font-size: 25px;
            height: max-content;
            font-weight: 100;
        }
    </style>

</head>

<body style="font-family: Arial, sans-serif;">

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Employee";
    try {
        $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $con->prepare("SELECT employee_info.employee_id,employee_info.full_name,employee_info.department,employee_info.designation,
        employee_info.uan,employee_info.pf_no,employee_info.esi_no, employee_info.bank_name,employee_info.account_no,employee_info.doj,
        employee_info.email_id,employee_payinfo.basic_wage,employee_payinfo.epf,employee_payinfo.hra, employee_payinfo.professional_tax,
        employee_payinfo.conveyance_allowances,employee_payinfo.tds,employee_payinfo.medical_allowances,employee_payinfo.health_insurance,
        employee_payinfo.other_allowances,employee_payinfo.total_earning,employee_payinfo.total_deductions,employee_payinfo.net_salary,
        monthly_details.total_working_days,monthly_details.paid_days,monthly_details.lob_days,monthly_details.leaves_taken
        FROM employee_info
        INNER JOIN employee_payinfo ON employee_info.employee_id=employee_payinfo.employee_id
        INNER JOIN monthly_details ON employee_payinfo.employee_id=monthly_details.employee_id ;");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        echo "<div class='center'>
            <b style='font-size:25px;' class='cname'>Ecorfy Technology Private Limited Company </b>
            <br>
            <b class='caddress'>Address of the Company</b>
            <br>
            <b class='cdate'>Pay Slip for " . date('F') . " " . date('Y') . "</b>
            <br><br><br>
            </div>";
            foreach($res as $row) {
            echo "<table>";
            echo "<tr>";
                echo "<td>Name of the Employee</td>";
                echo "<td>" . $row['full_name'] . "</td>";
                echo "<td>UAN</td>";
                echo "<td>" . $row['uan'] . "</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Employee ID</td>";
                echo "<td>" . $row['employee_id'] . "</td>";
                echo "<td>PF No</td>";
                echo "<td>" . $row['pf_no'] . "</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Designation</td>";
                echo "<td>" . $row['designation'] . " </td>";
                echo "<td>ESI No </td>";
                echo "<td>" . $row['esi_no'] . " </td>";
            echo " </tr>";
            echo "<tr>";
                echo "<td>Department </td>";
                echo "<td>" . $row['department'] . " </td>";
                echo "<td>Bank Name</td>";
                echo "<td> " . $row['bank_name'] . "</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>DOJ</td>";
                echo "<td>" . $row['doj'] . " </td>";
                echo "<td>Bank A/C No</td>";
                echo "<td>" . $row['account_no'] . " </td>
            </tr>";
            echo "</table>";
            echo "<table>
                   <tr>
                   <th> </th>
                   </tr>
            </table>
            <table>";
            echo " <tr>";
                echo "<td>Total Working Days </td>";
                echo "<td>" . $row['total_working_days'] . " </td>";
                echo " <td>Paid Days</td>";
                echo " <td>" . $row['paid_days'] . " </td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>LOB Days</td>";
                echo "<td>" . $row['lob_days'] . " </td>";
                echo " <td>Leaves Taken</td>";
                echo "<td>" . $row['leaves_taken'] . " </td>";
            echo "</tr>";
        
           echo "</table>";
           echo "<table>
            <tr>
               <th>  </th>
            </tr>
            </table>";
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
            echo "<tr>
                <td>Basic Wage</td>";
                echo "<td>Rs." . $row['basic_wage'] . "</td>";
                echo "<td>EPF</td>";
                echo "<td>Rs." . $row['epf'] . "</td>";
            echo "</tr>
            <tr>
                <td>HRA</td>";
                echo "<td>Rs." . $row['hra'] . "</td>";
                echo "<td>Professional Tax</td>";
                echo "<td>Rs." . $row['professional_tax'] . " </td>";
            echo "</tr>
            <tr>
                <td>Conveyance Allowances</td>";
                echo "<td>Rs." . $row['conveyance_allowances'] . "</td>";
                echo "<td>TDS </td>";
                echo "<td>Rs." . $row['tds'] . "</td>";
            echo "</tr>
            <tr>
                <td>Medical Allowances </td>";
                echo "<td>Rs." . $row['medical_allowances'] . " </td>";
                echo "<td>ESI/Health Insurance</td>";
                echo "<td>Rs." . $row['health_insurance'] . "</td>";
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
            echo "</tr>
            </table>";
            echo "<table>
            <tr>
                <td class='netsalary'>
                    <b> Net Salary</b>
                </td>
                <td>
                    <b> Rs." . $row['net_salary'] . "</b>
                </td>
             </tr>
           </table>";


           
            };
            
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $con = null;
    ?>

</body>
<html>