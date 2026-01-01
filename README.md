# Vanilla PHP Mobile Movie Download System

A simple, mobile-only movie download system built with vanilla PHP.

## Features

- **Mobile-Only Access**: Automatically detects mobile devices and restricts access to mobile users only
- **Two-Page System**:
  - **index.php**: Displays movie poster, info, and download options
  - **download.php**: Shows file details and download button
- **Clean Design**: Modern, responsive UI with gradient backgrounds
- **Multiple Quality Options**: Support for different file qualities (700MB, 720p, 1080p)

## Files

- `index.php` - Main movie information page with download buttons
- `download.php` - Download confirmation and file download trigger page
- `.gitignore` - Git ignore configuration

## Usage

1. Place the PHP files on a web server with PHP support
2. Access `index.php` from a mobile device
3. Select a download quality
4. Click "Start Download" on the download page

## Customization

To add your own movie:

1. Open `index.php`
2. Modify the `$movie` array with your movie data:
   - `title`: Movie title
   - `year`: Release year
   - `language`: Movie language
   - `poster`: URL to movie poster image
   - `downloads`: Array of download options with quality, size, and URL

## Requirements

- PHP 7.0 or higher
- Web server (Apache, Nginx, etc.)
- Mobile device for access

## Security Note

This is a basic implementation for demonstration purposes. For production use, consider adding:
- Input validation and sanitization
- Authentication/authorization
- Rate limiting
- Secure file storage
- HTTPS enforcement
