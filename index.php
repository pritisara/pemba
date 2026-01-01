<?php
// Mobile detection
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$is_mobile = preg_match('/(android|iphone|ipad|mobile)/i', $user_agent);

if (!$is_mobile) {
    die('This site is only accessible from mobile devices.');
}

// Movie data (hardcoded)
$movie = [
    'title' => 'The Dark Knight',
    'year' => '2008',
    'language' => 'English',
    'poster' => 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg',
    'downloads' => [
        [
            'quality' => '700MB',
            'size' => '700MB',
            'url' => 'https://example.com/movies/the-dark-knight-700mb.mp4'
        ],
        [
            'quality' => '720p',
            'size' => '1.2GB',
            'url' => 'https://example.com/movies/the-dark-knight-720p.mp4'
        ],
        [
            'quality' => '1080p',
            'size' => '2.5GB',
            'url' => 'https://example.com/movies/the-dark-knight-1080p.mp4'
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['title']); ?> - Download</title>
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
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .poster-container {
            position: relative;
            width: 100%;
            padding-top: 150%;
            background: #f0f0f0;
            overflow: hidden;
        }

        .poster-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .movie-info {
            padding: 20px;
            background: white;
        }

        .movie-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2d3748;
        }

        .movie-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            color: #718096;
            font-size: 14px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .downloads-section {
            padding: 20px;
            background: #f7fafc;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2d3748;
        }

        .download-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .download-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .download-btn:active {
            transform: translateY(2px);
            box-shadow: 0 2px 6px rgba(102, 126, 234, 0.4);
        }

        .quality-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .size-info {
            font-size: 14px;
            opacity: 0.9;
        }

        .download-icon {
            margin-left: 10px;
        }

        @media (max-width: 400px) {
            .movie-title {
                font-size: 24px;
            }

            .download-btn {
                padding: 14px 16px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="poster-container">
            <img src="<?php echo htmlspecialchars($movie['poster']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?> Poster">
        </div>

        <div class="movie-info">
            <h1 class="movie-title"><?php echo htmlspecialchars($movie['title']); ?></h1>
            <div class="movie-meta">
                <div class="meta-item">
                    <span>📅</span>
                    <span><?php echo htmlspecialchars($movie['year']); ?></span>
                </div>
                <div class="meta-item">
                    <span>🌐</span>
                    <span><?php echo htmlspecialchars($movie['language']); ?></span>
                </div>
            </div>
        </div>

        <div class="downloads-section">
            <h2 class="section-title">Download Options</h2>
            <div class="download-buttons">
                <?php foreach ($movie['downloads'] as $download): ?>
                    <a href="download.php?quality=<?php echo urlencode($download['quality']); ?>&url=<?php echo urlencode($download['url']); ?>&size=<?php echo urlencode($download['size']); ?>&title=<?php echo urlencode($movie['title']); ?>" class="download-btn">
                        <div>
                            <span class="quality-badge"><?php echo htmlspecialchars($download['quality']); ?></span>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <span class="size-info"><?php echo htmlspecialchars($download['size']); ?></span>
                            <span class="download-icon">⬇️</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
