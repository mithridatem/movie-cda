# movie-cda
projet de cours CDA movie

## 1 Cloner ou fork du repository
```sh
git clone https://github.com/mithridatem/movie-cda.git
cd movie-cda
```

## 2 Installer les dépendances
```sh
composer install
```

## 3 Paramètrer le fichier .env
```sh
# créer ou éditer .env
APP_ENV=dev
APP_SECRET=
APP_SHARE_DIR=var/share
DEFAULT_URI=http://localhost
DATABASE_URL=
MESSENGER_TRANSPORT_DSN=doctrine://default?auto_setup=0
MAILER_DSN=null://null
CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'
###< nelmio/cors-bundle ###

###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
# créer ou éditer .env.dev
APP_SECRET=e72cbda888eb6d60b401bec9e2d9aa6a 
DATABASE_URL="mysql://root:@127.0.0.1:3306/movie-cda?serverVersion=10.4.32-MariaDB&charset=utf8mb4"
JWT_PASSPHRASE=ma_pass_phrase
```
## 4 créer les clé privé et publique
```sh
mkdir config/jwt
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

## 5 Créer la base de données
```sh
symfony console d:d:c
```

## 6 Générer les migrations
```sh
symfony console make:migration
```

## 7 Appliquer les migrations
```sh
symfony console d:m:m
```
