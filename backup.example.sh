#!/bin/bash

# Variables (Update these before running the script)
BACKUP_DIR="/path/to/backup/directory" # Replace with the path to your backup directory
MYSQL_VOLUME="your-mysql-volume-name"  # Replace with your MySQL volume name
MINIO_VOLUME="your-minio-volume-name"  # Replace with your MinIO volume name
MYSQL_BACKUP_FILE="$BACKUP_DIR/mysql_volume_backup.tar.gz"
MINIO_BACKUP_FILE="$BACKUP_DIR/minio_volume_backup.tar.gz"

# Ensure backup directory exists
echo "Ensuring backup directory exists..."
mkdir -p $BACKUP_DIR

# Step 1: Backup MySQL Volume
echo "Backing up MySQL volume..."
docker run --rm -v $MYSQL_VOLUME:/data -v $BACKUP_DIR:/backup alpine tar -czf /backup/mysql_volume_backup.tar.gz -C /data .
if [ $? -ne 0 ]; then
  echo "Failed to create MySQL volume backup."
  exit 1
fi
echo "MySQL volume backed up successfully to $MYSQL_BACKUP_FILE."

# Step 2: Backup MinIO Volume
echo "Backing up MinIO volume..."
docker run --rm -v $MINIO_VOLUME:/data -v $BACKUP_DIR:/backup alpine tar -czf /backup/minio_volume_backup.tar.gz -C /data .
if [ $? -ne 0 ]; then
  echo "Failed to create MinIO volume backup."
  exit 1
fi
echo "MinIO volume backed up successfully to $MINIO_BACKUP_FILE."

echo "Backup process completed."
