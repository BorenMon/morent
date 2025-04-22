echo "Resetting local changes..."
git reset --hard HEAD
git clean -fd

echo "Pulling latest code..."
git pull origin main
