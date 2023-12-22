<?php
// Use the autoloader for PhpSpreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Employee";

try {
    $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['import'])) {
        $inputFileName = $_FILES['file']['tmp_name'];
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $columns = array_shift($sheetData);

        $sql = "INSERT INTO employee_payinfo (" . implode(', ', $columns) . ") VALUES (:" . implode(', :', $columns) . ")";
        $stmt = $con->prepare($sql);

        foreach ($sheetData as $data) {
            foreach ($columns as $key => $column) {
                $stmt->bindValue(':' . $column, $data[$key]);
            }
            $stmt->execute();
        }

        echo "Data imported successfully.";
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$con = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="import" value="Import Data">
    </form>
</body>
</html>