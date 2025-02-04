# Docker Development Environment

This document outlines the setup and usage of the Docker-based development environment for the project.

## Prerequisites

Ensure the following tools are installed on your local machine:

- **Docker**: [Install Docker](https://docs.docker.com/get-docker/)
- **Docker Compose**: Included with Docker Desktop or install separately.

## Project Overview

This project uses a Dockerized environment for development, which includes services such as:

- Laravel application (PHP 8.2)
- Node.js (via Docker for frontend build tools)

## Setting Up the Development Environment

### 1. Configure Environment Variables

Copy the example `.env` file and adjust the values as needed:

```bash
cp .env.dev.example .env
```

- Ensure the following variables are correctly set in `.env`:
  - **Database credentials**
  - **S3 credentials**

### 2. Build and Start Docker Containers

Run the following command to build and start the containers:

```bash
sh dev.sh
```

This will:
- Build the Laravel container with PHP 8.2.
- Expose the Laravel application on `http://localhost:7000`.
- Map the Node.js development server to `http://localhost:5173`.

### 3. Run Laravel Migrations

Run the following commands inside the `laravel` container to install PHP and Node.js dependencies:

#### Access the container:
```bash
docker exec -it dev_morent_laravel bash
```

Run Migrations
```
php artisan migrate
```

Run database seeding (To get test/admin user)
```bash
php artisan db:seed
```

Access Web App Locally
Visit http://127.0.0.1:7000