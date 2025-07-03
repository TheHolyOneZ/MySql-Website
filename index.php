<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Tools - TheHolyOneZ</title>
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
        .main-card {
            position: relative;
            z-index: 1;
            background: rgba(30, 34, 45, 0.85);
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            padding: 3rem 3rem 2.5rem 3rem;
            max-width: 420px;
            width: 100%;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 2.2rem;
            letter-spacing: 1px;
        }
        .tool-btn {
            width: 100%;
            padding: 1.2rem 0;
            margin-bottom: 1.5rem;
            border-radius: 12px;
            border: none;
            background: linear-gradient(90deg, #00c6ff 0%, #0072ff 100%);
            color: #fff;
            font-size: 1.25rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(0, 191, 255, 0.08);
            transition: background 0.2s, transform 0.2s;
            text-decoration: none;
            display: block;
            text-align: center;
        }
        .tool-btn:hover {
            background: linear-gradient(90deg, #0072ff 0%, #00c6ff 100%);
            transform: translateY(-2px) scale(1.03);
        }
    </style>
</head>
<body>
    <div class="blur-bg"></div>
    <div class="watermark">Made By TheHolyOneZ</div>
    <div class="main-card">
        <h1>MySQL Tools</h1>
        <a href="web_backup.php" class="tool-btn">Backup Database</a>
        <a href="web_restore.php" class="tool-btn">Restore Database</a>
    </div>
</body>
</html> 