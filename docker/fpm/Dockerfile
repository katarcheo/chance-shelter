FROM php:8.5-fpm

ARG UID
ARG GID
ARG FPM_USER

RUN apt-get update && apt-get install -y \
      git \
      libpq-dev \
      libzip-dev \
      zlib1g-dev \
      vim \
      zip \
      unzip \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --link \
    --from=ghcr.io/symfony-cli/symfony-cli:latest \
    /usr/local/bin/symfony /usr/local/bin/symfony

RUN groupadd -g $GID $FPM_USER \
    && useradd -u $UID -g $GID -m $FPM_USER \
    && mkdir /app \
    && chown -R $FPM_USER:$FPM_USER /app

USER $FPM_USER
WORKDIR /app