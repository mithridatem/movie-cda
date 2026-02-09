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
DATABASE_URL=
# créer ou éditer .env.dev 
DATABASE_URL="mysql://root:@127.0.0.1:3306/movie-cda?serverVersion=10.4.32-MariaDB&charset=utf8mb4"
```

## 4 Créer la base de données
```sh
symfony console d:d:c
```

## 5 Générer les migrations
```sh
symfony console make:migration
```

## 6 Appliquer les migrations
```sh
symfony console d:m:m
```

