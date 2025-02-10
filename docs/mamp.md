# Development with MAMP

This guide covers setting up development using MAMP.

---

## Prerequisites

Ensure you have the following installed:

- [MAMP](https://www.mamp.info/en/)
- [Composer](https://getcomposer.org/)
- ( [Node.js](https://nodejs.org/) or [NVM](https://www.freecodecamp.org/news/node-version-manager-nvm-install-guide/) ) and [Yarn](https://classic.yarnpkg.com/lang/en/docs/install/#windows-stable)

## Step 1: Configure PHP
1. Set the system environment variable to use PHP 8.2.14 (commonly located at `C:\MAMP\bin\php\php8.2.14`).
2. Download the latest cacert.pem from [here](https://curl.se/ca/cacert.pem) and save it to `C:\MAMP\bin\php\php8.2.14\`
3. Edit php.ini (located in the PHP 8.2.14 folder) and uncomment the following lines:
    ```
    extension=curl
    extension=fileinfo
    extension=openssl
    openssl.cafile="C:\MAMP\bin\php\php8.2.14\extras\ssl\cacert.pem"
    extension_dir="ext"
    ```
4. Ensure that MAMP MySQL is running, or use the deployed DEV database "morent_dev" (recommended). If you choose the DEV database, follow these steps to connect successfully:
   
    - Install Cloudflare Tunnel on Windows or other OS by checking the [Installation Guide](https://developers.cloudflare.com/cloudflare-one/connections/connect-networks/downloads).
        ```
        winget install --id Cloudflare.cloudflared
        ```
    - Map your local port 3308 (or any available port you prefer) to securely access the DEV database via Cloudflare Tunnel.
        ```
        cloudflared access tcp --hostname morent-db.borenmon.dev --url 127.0.0.1:3308
        ```

## Step 2: Project Setup
Open a terminal at the project directory or use VS Code's integrated terminal (Git Bash recommended).
#### In First Terminal
```
cp .env.local.example .env
composer install
yarn install
yarn dev
```
#### Set Env Variables (.env)
```
AWS_ACCESS_KEY_ID=minio
AWS_SECRET_ACCESS_KEY=mino123
```
#### In Second Terminal
```
php artisan key:generate
php artisan serve

# If using MAMP
php artisan migrate
php artisan db:seed # To create test/admin user
```

## Access Web App Locally
Visit http://127.0.0.1:8000

## Manage Database with MAMP phpMyAdmin
Access phpMyAdmin via: http://localhost/phpMyAdmin5

## Next Time Running the Project
Make sure MAMP and MySQL are up and run the following command:
```
sh local.sh
```
