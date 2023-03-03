## Local setup
```bash
docker compose up -d
docker compose exec php composer update --prefer-dist
docker compose exec php composer install
docker compose exec php yii migrate --interactive 0
docker compose exec php chown www-data:www-data /app/web /app/web/assets /app/runtime
```
## API
```
/api/uploads?page=${page}
/api/uploads/count
/api/uploads/${id}
```
