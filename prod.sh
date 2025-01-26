docker compose -f docker-compose.dev.yml down

rm public/hot

docker compose up -d --build