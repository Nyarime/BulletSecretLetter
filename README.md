# BulletSecretLetter
One-time encrypted message self-destruct after reading.

## MySQL

### CREATE DATABASE privatenote

### Create table

CREATE TABLE IF NOT EXISTS `note` (
  `id` text NOT NULL,
  `message` text NOT NULL
) 

### edit 'sql.php'
