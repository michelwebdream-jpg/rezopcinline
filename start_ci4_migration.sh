#!/bin/bash

# Script de démarrage pour la migration CI3 → CI4
# Usage: ./start_ci4_migration.sh

echo "=========================================="
echo "Migration CodeIgniter 3 → CodeIgniter 4"
echo "=========================================="
echo ""

# Vérifier PHP
echo "1. Vérification de PHP..."
PHP_VERSION=$(php -r "echo PHP_VERSION;")
echo "   Version PHP: $PHP_VERSION"

if php -r "exit(version_compare(PHP_VERSION, '8.1.0', '<') ? 1 : 0);"; then
    echo "   ✅ PHP 8.1+ détecté"
else
    echo "   ❌ PHP 8.1+ requis. Version actuelle: $PHP_VERSION"
    exit 1
fi

# Vérifier Composer
echo ""
echo "2. Vérification de Composer..."
if command -v composer &> /dev/null; then
    COMPOSER_VERSION=$(composer --version | head -n 1)
    echo "   ✅ $COMPOSER_VERSION"
else
    echo "   ❌ Composer n'est pas installé"
    echo "   Installez Composer depuis: https://getcomposer.org/"
    exit 1
fi

# Créer le dossier de migration
echo ""
echo "3. Création du dossier de migration..."
MIGRATION_DIR="../rezopcinline-ci4"
if [ -d "$MIGRATION_DIR" ]; then
    echo "   ⚠️  Le dossier $MIGRATION_DIR existe déjà"
    read -p "   Voulez-vous le supprimer et recommencer? (o/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Oo]$ ]]; then
        rm -rf "$MIGRATION_DIR"
        echo "   ✅ Dossier supprimé"
    else
        echo "   ❌ Migration annulée"
        exit 1
    fi
fi

# Installer CI4
echo ""
echo "4. Installation de CodeIgniter 4..."
composer create-project codeigniter4/appstarter "$MIGRATION_DIR" --no-interaction

if [ $? -eq 0 ]; then
    echo "   ✅ CodeIgniter 4 installé dans $MIGRATION_DIR"
else
    echo "   ❌ Erreur lors de l'installation"
    exit 1
fi

# Copier les fichiers statiques
echo ""
echo "5. Copie des fichiers statiques..."
if [ -d "assets" ]; then
    cp -r assets "$MIGRATION_DIR/public/"
    echo "   ✅ Assets copiés"
fi

if [ -d "dev" ]; then
    cp -r dev "$MIGRATION_DIR/"
    echo "   ✅ Dossier dev/ copié"
fi

if [ -d "js" ]; then
    mkdir -p "$MIGRATION_DIR/public/js"
    cp -r js/* "$MIGRATION_DIR/public/js/"
    echo "   ✅ JavaScript copié"
fi

# Créer le fichier .env
echo ""
echo "6. Configuration de l'environnement..."
cat > "$MIGRATION_DIR/.env" << 'EOF'
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------
CI_ENVIRONMENT = development

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------
app.baseURL = 'https://localhost/rezopcinline/'
app.forceGlobalSecureRequests = false

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
database.default.hostname = 127.0.0.1
database.default.database = webdreamblog
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi

#--------------------------------------------------------------------
# SERVER URLs
#--------------------------------------------------------------------
APP_SERVER_URL=https://www.web-dream.fr
LIT_INFO_ADMINISTRATEUR_URI=/dev/rezo_flash_code/lit_info_administrateur.php
SENDPASSWORD_URI=/dev/rezo_flash_code/send_password.php
UPDATEPASSWORD_URI=/dev/rezo_flash_code/update_password.php
UPDATEUSER_URI=/dev/rezo_flash_code/updateuser_customer.php
AJOUTE_CODE_PC_TABLE_CONTACT_URI=/dev/rezo_flash_code/ajoute_code_pc_table_contact.php
MAJ_APP_POUR_GALERIE_PHOTO_URI=/dev/rezo_flash_code/maj_app_pour_galerie_photo.php
REGISTER_URI=/dev/rezo_flash_code/creat_customer.php
EOF
echo "   ✅ Fichier .env créé"

# Créer la structure de base
echo ""
echo "7. Création de la structure de base..."
mkdir -p "$MIGRATION_DIR/app/Controllers"
mkdir -p "$MIGRATION_DIR/app/Models"
mkdir -p "$MIGRATION_DIR/app/Views"
mkdir -p "$MIGRATION_DIR/app/Config"

echo ""
echo "=========================================="
echo "✅ Migration initialisée avec succès!"
echo "=========================================="
echo ""
echo "Prochaines étapes:"
echo "1. cd $MIGRATION_DIR"
echo "2. Consultez CI4_MIGRATION_GUIDE.md pour les détails"
echo "3. Consultez CI4_MIGRATION_EXAMPLES.md pour les exemples"
echo "4. Commencez par migrer les controllers un par un"
echo ""
echo "Bon courage! 🚀"

