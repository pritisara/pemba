<?php
// Mobile detection
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$is_mobile = preg_match('/(android|iphone|ipad|mobile)/i', $user_agent);

if (!$is_mobile) {
    die('This site is only accessible from mobile devices.');
}

// Get parameters from URL
$quality = $_GET['quality'] ?? '';
$file_url = $_GET['url'] ?? '';
$file_size = $_GET['size'] ?? '';
$movie_title = $_GET['title'] ?? 'Movie';

// Validate required parameters
if (empty($quality) || empty($file_url) || empty($file_size)) {
    die('Invalid download parameters.');
}

// Handle actual download trigger
if (isset($_GET['action']) && $_GET['action'] === 'download') {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . preg_replace('/[^a-zA-Z0-9-_\.]/', '', $movie_title) . '-' . $quality . '.mp4"');
    header('Location: ' . $file_url);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download <?php echo htmlspecialchars($movie_title); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .content {
            padding: 30px 20px;
        }

        .file-info {
            background: #f7fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        .info-value {
            color: #2d3748;
            font-weight: 500;
            font-size: 15px;
        }

        .quality-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .download-button {
            display: block;
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 12px;
            font-weight: 700;
            font-size: 18px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 6px 20px rgba(72, 187, 120, 0.4);
            border: none;
            cursor: pointer;
        }

        .download-button:active {
            transform: translateY(2px);
            box-shadow: 0 3px 10px rgba(72, 187, 120, 0.4);
        }

        .download-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .note {
            background: #fef5e7;
            border-left: 4px solid #f39c12;
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
            font-size: 13px;
            color: #6d4c41;
        }

        .note-title {
            font-weight: 700;
            margin-bottom: 5px;
            color: #e67e22;
        }

        @media (max-width: 400px) {
            .header h1 {
                font-size: 20px;
            }

            .download-button {
                font-size: 16px;
                padding: 16px;
            }

            .content {
                padding: 25px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎬 Ready to Download</h1>
            <p>Your movie is ready</p>
        </div>

        <div class="content">
            <div class="file-info">
                <div class="info-row">
                    <span class="info-label">Movie Title</span>
                    <span class="info-value"><?php echo htmlspecialchars($movie_title); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Quality</span>
                    <span class="quality-badge"><?php echo htmlspecialchars($quality); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">File Size</span>
                    <span class="info-value"><?php echo htmlspecialchars($file_size); ?></span>
                </div>
            </div>

            <a href="?quality=<?php echo urlencode($quality); ?>&url=<?php echo urlencode($file_url); ?>&size=<?php echo urlencode($file_size); ?>&title=<?php echo urlencode($movie_title); ?>&action=download" class="download-button">
                <span class="download-icon">⬇️</span>
                Start Download
            </a>

            <a href="index.php" class="back-link">← Back to Movie Page</a>

            <div class="note">
                <div class="note-title">📱 Download Instructions</div>
                <div>Tap "Start Download" to begin downloading. The file will be saved to your device's downloads folder.</div>
            </div>
        </div>
    </div>
</body>
</html>
