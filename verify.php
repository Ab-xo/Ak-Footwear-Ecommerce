<?php
// Database connection (reuse the connection code)
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

// Check if email and token are present
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Verify the token
    $stmt = $pdo->prepare("SELECT * FROM newsletter_subscribers WHERE email = ? AND token = ?");
    $stmt->execute([$email, $token]);
    $subscriber = $stmt->fetch();

    if ($subscriber && !$subscriber['is_verified']) {
        // Update the status to verified
        $stmt = $pdo->prepare("UPDATE newsletter_subscribers SET is_verified = 1 WHERE email = ? AND token = ?");
        $stmt->execute([$email, $token]);
        echo "Your email has been successfully verified! Thank you for subscribing to our newsletter.";
    } else {
        echo "Invalid or already verified link.";
    }
} else {
    echo "Invalid verification link.";
}

