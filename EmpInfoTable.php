<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    require 'vendor/tecnickcom/tcpdf/tcpdf.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
    require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

    class PayslipGenerator
    {
        public $employeeData;
        function __construct($employeeData)
        {
            $this->employeeData = $employeeData;
        }
        public function generatePayslip($employee)
        {
            //Email Payslip Pdf
            ob_start();
            include 'EmpInfo.php';
            $pdfpayslip = ob_get_clean();
            //Email Payslip content
            ob_start();
            include 'payslipEmail.php';
            $emailcontent = ob_get_clean();

            //   $payslip =  "<h1>Payslip for October 2023</h1>
            //   <p>Employee Name: $employee[name]</p>
            //   <p>Employee ID: $employee[id]</p>
            //   <p>Salary: 50000</p>
            //   <p>Net Pay: 45000</p>";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;

                $mail->Username = 'pranpathak01@gmail.com';
                $mail->Password = 'wwfu mlzi kiux whaf';
                
                // Recipients
                $mail->setFrom('pranpathak01@gmail.com', 'Pransu Pathak'); // Sender's email and name
                $mail->addAddress($employee['email'], $employee['name']); // Recipient's email and name
                $mail->isHTML(true);
                $mail->Subject = 'Payslip for October 2023';
                $mail->Body =  "Dear " . $employee['name'] . ","."<br><br>".$emailcontent;
                //code for convert html to pdf
                $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

                // Set document information
                $pdf->SetCreator('Your Name');
                $pdf->SetAuthor('Your Name');
                $pdf->SetTitle('Payslip');
                $pdf->SetSubject('Payslip for October 2023');
                $pdf->SetKeywords('Payslip, PDF, HTML, PHP');

                // Remove default header/footer
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);

                // Add a page
                $pdf->AddPage();

                // Set some content to print
                $html = $pdfpayslip;

                // Convert HTML to PDF
                $pdf->writeHTML($html, true, false, true, false, '');

                $pdfFile =$employee['id']."-".date('F')."-".date('Y').".pdf";
                $attachment = $pdf->Output($pdfFile, 'S');
                
                // Attach the generated PDF
                $mail->addStringAttachment($attachment,$pdfFile );

                // Send the email
                $mail->send();
                echo "Email message sent to " . $employee['name'] . "<br>";
            } catch (Exception $e) {
                echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        public function sendEmail()
        {
            foreach ($this->employeeData as $employee) {
                $this->generatePayslip($employee);
                echo var_dump($employee) . "<br>";
            }
        }
    }
    $payslipGenerator = new PayslipGenerator($employeeData);
    $payslipGenerator->sendEmail();
    ?>

</body>

</html>