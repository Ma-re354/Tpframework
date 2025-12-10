# Déploiement Render - Guide de Configuration

## Informations de la Base de Données Aiven

La base de données MySQL est hébergée sur Aiven avec les paramètres suivants:

- **Host**: mysql-1d3a9ed-tianrymareol330-f73e.j.aivencloud.com
- **Port**: 14657
- **Database**: defaultdb
- **Username**: avnadmin
- **SSL Mode**: REQUIRED

## Configuration Render

### Variables d'Environnement à Configurer

1. **APP_NAME**: CultureBenin
2. **APP_ENV**: production
3. **APP_DEBUG**: false
4. **APP_KEY**: (Générer avec `php artisan key:generate`)
5. **APP_URL**: (Votre URL Render, ex: https://culturebenin.onrender.com)

### Base de Données

Ces variables sont déjà configurées dans `render.yaml`:

- **DB_CONNECTION**: mysql
- **DB_HOST**: mysql-1d3a9ed-tianrymareol330-f73e.j.aivencloud.com
- **DB_PORT**: 14657
- **DB_DATABASE**: defaultdb
- **DB_USERNAME**: avnadmin
- **DB_PASSWORD**: (À défnir dans Render Dashboard comme variable secrète)
- **MYSQL_ATTR_SSL_CA**: /etc/ssl/certs/ca-certificates.crt

### Sessions, Queues et Cache

Pour éviter les dépendances externes:

- **SESSION_DRIVER**: database (utilise les sessions en BD)
- **QUEUE_CONNECTION**: sync (exécution synchrone sans worker)
- **CACHE_STORE**: file (cache fichiers système)

## Processus de Déploiement

1. Push le code sur GitHub
2. Render détecte automatiquement le `render.yaml`
3. **Build**: `composer install --no-dev --optimize-autoloader && php artisan config:clear && php artisan migrate --force`
4. **Start**: `php artisan serve --host=0.0.0.0 --port=$PORT`

## Migrations Automatiques

Les migrations se lancent automatiquement lors du build avec `--force`. Si une migration échoue:

1. Connectez-vous au dashboard Render
2. Consultez les logs de build
3. Vous pouvez exécuter manuellement: `php artisan migrate --force`

## Fichiers Clés Modifiés

- `render.yaml`: Configuration complète Render avec toutes les variables
- `Dockerfile`: Support SSL Aiven + variable PORT dynamique
- `.env.example`: Template avec MYSQL_ATTR_SSL_CA
- `config/database.php`: Configuration SSL pour PDO MySQL

## Notes de Sécurité

⚠️ **IMPORTANT**: 
- Le mot de passe Aiven doit être défini comme variable secrète dans Render Dashboard
- Ne jamais committer les credentials réels dans Git
- Le `.env` est dans `.gitignore` par défaut
