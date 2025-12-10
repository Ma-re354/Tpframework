# Utiliser l'image PHP 8.2 avec FPM
FROM php:8.2-fpm

# Installer les dépendances systèmes nécessaires
# Ajout de default-mysql-client pour les outils MySQL (y compris SSL)
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpng-dev libonig-dev libxml2-dev libpq-dev libjpeg-dev libfreetype6-dev \
    postgresql-client default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Configurer GD avec JPEG/Freetype
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le projet
COPY . .

# IMPORTANT : Copier le certificat CA Aiven (nommé 'ca.pem' dans cet exemple)
# Assurez-vous d'avoir ce fichier dans votre dépôt Git et de l'avoir nommé 'ca.pem'
COPY ca.pem /etc/ssl/certs/aiven-ca.pem

# Installer les dépendances Laravel (sans scripts)
# --no-scripts permet d'éviter les appels à 'artisan' qui échoueraient à la construction
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Donner les bonnes permissions aux dossiers storage et cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port
EXPOSE 8000

# Démarrer le conteneur et exécuter les tâches de déploiement
# 1. php artisan config:clear : Force la lecture des variables d'environnement Render (y compris l'hôte et la configuration SSL).
# 2. php artisan migrate --force : Exécute les migrations (maintenant que la configuration DB est propre et utilise le SSL).
# 3. php artisan serve : Lance le serveur.
CMD sh -c "php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"