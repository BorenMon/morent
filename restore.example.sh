#!/bin/bash

# Variables (Update these before running the script)
BACKUP_DIR="./backup" # Replace with the path to your backup directory
MYSQL_VOLUME="your_mysql_volume_name"  # Replace with your MySQL volume name
MINIO_VOLUME="your_minio_volume_name"  # Replace with your MinIO volume name
MYSQL_BACKUP_FILE="$BACKUP_DIR/mysql_volume_backup.tar.gz"
MINIO_BACKUP_FILE="$BACKUP_DIR/minio_volume_backup.tar.gz"

# Check if backup files exist
if [ ! -f "$MYSQL_BACKUP_FILE" ]; then
  echo "Error: MySQL backup file not found at $MYSQL_BACKUP_FILE"
  exit 1
fi

if [ ! -f "$MINIO_BACKUP_FILE" ]; then
  echo "Error: MinIO backup file not found at $MINIO_BACKUP_FILE"
  exit 1
fi

# Step 1: Restore MySQL Volume
echo "Restoring MySQL volume..."
docker run --rm -v $MYSQL_VOLUME:/var/lib/mysql -v $BACKUP_DIR:/backup alpine sh -c "tar -xzf /backup/mysql_volume_backup.tar.gz -C /var/lib/mysql"
if [ $? -ne 0 ]; then
  echo "Failed to restore MySQL volume."
  exit 1
fi
echo "MySQL volume restored successfully."

# Step 2: Restore MinIO Volume
echo "Restoring MinIO volume..."
docker run --rm -v $MINIO_VOLUME:/data -v $BACKUP_DIR:/backup alpine sh -c "tar -xzf /backup/minio_volume_backup.tar.gz -C /data"
if [ $? -ne 0 ]; then
  echo "Failed to restore MinIO volume."
  exit 1
fi
echo "MinIO volume restored successfully."

docker compose restart

echo "Restore process completed."
