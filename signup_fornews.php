<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Signup</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Your form and other content here -->

    <!-- Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="messageContent">
                    <!-- Message content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#messageModal').on('hidden.bs.modal', function () {
                window.location.href = 'index.php';
            });
        });

        function showMessage(message) {
            $('#messageContent').html(message);
            $('#messageModal').modal('show');
        }
    </script>

    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Include PHPMailer autoload file
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    // Database connection (adjust with your own settings)
    $host = 'localhost';
    $db = 'myphp_login';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate email
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>showMessage('Invalid email format');</script>";
            exit;
        }

        // Generate a unique token
        $token = bin2hex(random_bytes(16));

        // Store email and token in the database
        $stmt = $pdo->prepare("INSERT INTO newsletter_subscribers (email, token) VALUES (?, ?)");
        $stmt->execute([$email, $token]);

        // Instantiate PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true; 
            $mail->Username   = 'gebeyehuabraham19@gmail.com'; 
            $mail->Password   = 'tnuwekvgdmmhpjec'; 
            $mail->SMTPSecure = 'ssl'; 
            $mail->Port       = 465; 

            // Recipients
            $mail->setFrom('gebeyehuabraham19@gmail.com', 'Abraham Gebeyehu'); 
            $mail->addAddress($email); 

            // Content
            $mail->isHTML(true); 
            $mail->Subject = 'Verify Your Newsletter Subscription';
            $mail->Body    = "Please click the link below to verify your subscription:<br><a href='http://yourwebsite.com/verify.php?email=$email&token=$token'>Verify Email</a>";

            // Send email
            $mail->send();
            echo "<script>showMessage('Thank you for subscribing! Please check your email to verify your subscription.');</script>";
        } catch (Exception $e) {
            echo "<script>showMessage('Oops! Something went wrong. Please try again later. Error: {$mail->ErrorInfo}');</script>";
        }
    }
    ?>
</body>
</html>
