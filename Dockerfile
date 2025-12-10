# Utiliser PHP 8.2 (Version CLI suffit si on utilise artisan serve, mais FPM est ok)
FROM php:8.2-fpm

# Installer les dépendances systèmes
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpng-dev libonig-dev libxml2-dev libpq-dev libjpeg-dev libfreetype6-dev \
    postgresql-client \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Configurer GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Installer les extensions PHP
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Répertoire de travail
WORKDIR /var/www/html

# Copier le projet
COPY . .

# Installer les dépendances (sans scripts pour éviter les erreurs liées à la DB ici)
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port
EXPOSE 8000

# --- C'EST ICI QUE TOUT CHANGE ---
# On utilise "sh -c" pour enchaîner les commandes AU DÉMARRAGE seulement.
# 1. On force le nettoyage de la config pour être sûr de lire les variables Render.
# 2. On joue les migrations (si la DB est prête).
# 3. On lance le serveur.

CMD sh -c "php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"