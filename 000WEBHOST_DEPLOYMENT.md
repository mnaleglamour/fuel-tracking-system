# 000webhost Deployment Guide

## Prerequisites
- FTP Client (FileZilla recommended: https://filezilla-project.org)
- 000webhost account created

## Steps

### 1. Connect via FTP
- Open FileZilla
- Enter FTP credentials from 000webhost dashboard
- Connect

### 2. Upload Project
- Navigate to your domain's public folder
- Upload all files from Laravel project root

### 3. Create Database via cPanel
- In 000webhost dashboard, click "Manage"
- Go to cPanel
- Find "MySQL Databases"
- Create database: `tracking`
- Create user: `tracking_user`
- Add user to database (all privileges)

### 4. Set .env File
- Upload .env file with these settings:
```
APP_NAME="Fuel Tracking System"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.000webhostapp.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=tracking
DB_USERNAME=tracking_user
DB_PASSWORD=your_password_here

CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### 5. Run Migrations
- Connect via SSH or use cPanel Terminal
- Run: `php artisan migrate:fresh --seed`

### 6. Set Permissions
- In File Manager, set these to 755:
  - storage/
  - bootstrap/cache/

## Done!
Your app should now be live at: https://your-domain.000webhostapp.com
