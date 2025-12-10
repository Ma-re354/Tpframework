#!/bin/bash
# Script pour générer APP_KEY localement avant déploiement Render

echo "=== Génération de l'APP_KEY pour Render ==="
echo ""
echo "Exécutez cette commande localement:"
echo "php artisan key:generate --show"
echo ""
echo "Cela affichera votre APP_KEY en format base64:xxxxx"
echo "Copiez-le et collez-le dans Render Dashboard sous:"
echo "  Environment > APP_KEY"
echo ""
echo "Ensuite, déployez sur Render normalement."
