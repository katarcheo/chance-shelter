build:
	docker compose up --build

dup:
	docker compose up -d

up:
	docker compose up

down:
	docker compose down

app-bash:
	docker compose exec app bash

nginx-bash:
	docker compose exec nginx bash

db-bash:
	docker compose exec database bash


PHP_CONTAINER=app

# -------------------------------
# Сервер
listen:
	docker compose exec -T $(PHP_CONTAINER) symfony server:start --listen-ip=0.0.0.0

dlisten:
	docker compose exec -T $(PHP_CONTAINER) symfony server:start --listen-ip=0.0.0.0 -d

stop:
	docker compose exec -T $(PHP_CONTAINER) symfony server:stop

# -------------------------------
# Чтобы Make не ругался на неизвестные цели
%:
	@: