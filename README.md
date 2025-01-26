# Docker Development Environment

This document outlines the setup and usage of the Docker-based development environment for the project.

## Prerequisites

Ensure the following tools are installed on your local machine:

- **Docker**: [Install Docker](https://docs.docker.com/get-docker/)
- **Docker Compose**: Included with Docker Desktop or install separately.
- **Git**: [Install Git](https://git-scm.com/downloads)
- **Cloudflare Tunnel**: [Install Cloudflare Tunnel](https://developers.cloudflare.com/cloudflare-one/connections/connect-networks/downloads/) (Optional)

## Project Overview

This project uses a Dockerized environment for development, which includes services such as:

- Laravel application (PHP 8.2)
- Node.js (via Docker for frontend build tools)

## Setting Up the Development Environment

### 1. Clone the Repository

```bash
git clone git@github.com:BorenMon/morent-admin-console.git
cd morent-admin-console
```

### 2. Configure Environment Variables

Copy the example `.env` file and adjust the values as needed:

```bash
cp .env.dev.example .env
```

- Ensure the following variables are correctly set in `.env`:
  - **Database credentials**
  - **S3 credentials**

### 3. Build and Start Docker Containers

Run the following command to build and start the containers:

```bash
sh dev.sh
```

This will:
- Build the Laravel container with PHP 8.2.
- Expose the Laravel application on `http://localhost:7000`.
- Map the Node.js development server to `http://localhost:5173`.

### 4. Run Laravel Migrations

Run the following commands inside the `laravel` container to install PHP and Node.js dependencies:

#### Access the container:

```bash
docker exec -it morent-admin-console_laravel bash
```

Run database seeding (To get test user)

```bash
php artisan db:seed
```

## Additional Information

### Cloudflare Tunnel

To connect to the deployed MySQL server (`morent-admin-db.borenmon.dev`) from outside the container, run the following command:

```bash
cloudflared access tcp --hostname morent-admin-db.borenmon.dev --url 127.0.0.1:3308
```

This command establishes a connection, allowing you to access the MySQL server with:
- **Hostname:** 127.0.0.1
- **Port:** 3308

## Troubleshooting

- **S3 Connection Issues:** Verify the `AWS_ENDPOINT` and credentials.
- **Database Connection Errors:** Ensure the database container or external database is accessible and correctly configured in `.env`.

## License

This project is licensed under the [MIT License](LICENSE).

