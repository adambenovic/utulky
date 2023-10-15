# PawHub Backend + Admin

```shell
SERVER_NAME=:80 \
APP_SECRET=ChangeMe \
CADDY_MERCURE_JWT_SECRET=ChangeThisMercureHubJWTSecretKey \
docker compose -f docker-compose.yml -f docker-compose.override.yml up -d --wait
```
