#!/bin/bash

# Check if a path is provided
if [ -z "$1" ]; then
    echo "Usage: $0 <path>"
    exit 1
fi

TARGET_DIR="$1"

# Check if the directory exists
if [ ! -d "$TARGET_DIR" ]; then
    echo "Error: Directory '$TARGET_DIR' does not exist."
    exit 1
fi

# Change ownership to the current user
sudo chown -R $(whoami):$(whoami) "$TARGET_DIR"

# Set directory permissions to 755
find "$TARGET_DIR" -type d -exec chmod 755 {} \;

# Set file permissions to 644
find "$TARGET_DIR" -type f -exec chmod 644 {} \;

echo "Permissions fixed for: $TARGET_DIR"
