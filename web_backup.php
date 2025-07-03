<?php
// Handle form submission
$success = null;
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_host = $_POST['db_host'] ?? '';
    $db_user = $_POST['db_user'] ?? '';
    $db_pass = $_POST['db_pass'] ?? '';
    $db_name = $_POST['db_name'] ?? '';

    if ($db_host && $db_user && $db_name) {
        $backup_file = sys_get_temp_dir() . '/db_backup_' . $db_name . '_' . date('Ymd_His') . '.sql';
        $cmd = sprintf(
            'mysqldump -h%s -u%s -p%s %s > %s',
            escapeshellarg($db_host),
            escapeshellarg($db_user),
            escapeshellarg($db_pass),
            escapeshellarg($db_name),
            escapeshellarg($backup_file)
        );
        system($cmd, $retval);
        if ($retval === 0 && file_exists($backup_file)) {
            header('Content-Type: application/sql');
            header('Content-Disposition: attachment; filename="' . basename($backup_file) . '"');
            readfile($backup_file);
            unlink($backup_file);
            exit;
        } else {
            $error = "Backup failed. Please check your credentials and permissions.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Database Backup</title>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #232526 0%, #414345 100%);
            position: relative;
        }
        .blur-bg {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            backdrop-filter: blur(8px) brightness(0.7);
            z-index: 0;
        }
        .watermark {
            position: fixed;
            bottom: 24px;
            right: 32px;
            z-index: 10;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            opacity: 0.08;
            pointer-events: none;
            user-select: none;
            letter-spacing: 2px;
        }
        .card {
            position: relative;
            z-index: 1;
            background: rgba(30, 34, 45, 0.85);
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            max-width: 400px;
            width: 100%;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .back-link {
            position: absolute;
            top: 18px;
            left: 24px;
            color: #00c6ff;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            opacity: 0.8;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #fff;
            opacity: 1;
        }
        h2 {
            margin-bottom: 1.5rem;
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        input[type="text"], input[type="password"] {
            padding: 0.8rem 1rem;
            border-radius: 8px;
            border: none;
            background: rgba(255,255,255,0.08);
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: background 0.2s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            background: rgba(255,255,255,0.15);
        }
        button {
            padding: 0.9rem 1.2rem;
            border-radius: 8px;
            border: none;
            background: linear-gradient(90deg, #00c6ff 0%, #0072ff 100%);
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: background 0.2s, transform 0.2s;
        }
        button:hover {
            background: linear-gradient(90deg, #0072ff 0%, #00c6ff 100%);
            transform: translateY(-2px) scale(1.03);
        }
        .msg {
            margin-bottom: 1rem;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            width: 100%;
            text-align: center;
        }
        .msg.error {
            background: rgba(255, 0, 60, 0.15);
            color: #ff003c;
        }
        .msg.success {
            background: rgba(0, 255, 120, 0.12);
            color: #00ff78;
        }
    </style>
</head>
<body>
    <div class="blur-bg"></div>
    <div class="watermark">Made By TheHolyOneZ</div>
    <div class="card">
        <a href="index.php" class="back-link">&larr; Back to Home</a>
        <h2>MySQL Database Backup</h2>
        <?php if ($error): ?>
            <div class="msg error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <input type="text" name="db_host" placeholder="Database Host" required>
            <input type="text" name="db_user" placeholder="Database User" required>
            <input type="password" name="db_pass" placeholder="Database Password">
            <input type="text" name="db_name" placeholder="Database Name" required>
            <button type="submit">Download Backup</button>
        </form>
    </div>
</body>
</html> 