# Bullet Secret Letter
One-time encrypted message self-destruct after reading.

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

* This is the community open source version
* If you don’t want to build it, please visit https://biu.li/

# Features
* Added clipboard.js to click and copy the generated link
* Added Mata information, which can display the title of the bullet secret letter in the preview in Telegram and other applications
* Fix some browser display abnormalities, adapt to mobile browsers such as Safari
* Provide QRCode generation services based on idc.moe, which can quickly generate linked QR codes
* Solve the problem of invalidation of the generated bullet secret letter link due to the link preview function of Tencent (QQ, WeChat), Twitter, Facebook, and Telegram

# Install
## Web

## DataBase
Here we use MySQL database software, at least MySQL5.6 and above are required. Biu.Li uses MySQL 8.0 database software.

### CREATE DATABASE

Create database

```SQL
CREATE DATABASE BulletSecretLetter
```
Create table
```SQL
CREATE TABLE IF NOT EXISTS `note` (
  `id` text NOT NULL,
  `message` text NOT NULL
) 
```

## Configuration
### edit 'sql.php'

# Demo Website
You can visit on https://biu.li

## Use the following items for secondary development
https://github.com/guillaC/privateNote
