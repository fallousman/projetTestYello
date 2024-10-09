# Projet Test Yello

## Description
Ce projet est une API RESTful pour gérer des cours éducatifs, permettant aux utilisateurs d'ajouter, de récupérer, de mettre à jour et de supprimer des cours.

## Fonctionnalités
- Ajouter des cours
- Récupérer la liste de tous les cours
- Récupérer un cour specifique grace avec l'ID
- Mettre à jour des cours avec l'ID
- Supprimer des cours

## Technologies utilisées
- PHP
- PHPUnit pour les tests unitaires
- Mysql pour la base de donnee
- Nous avons choisi PHP et MySQL pour ce projet pour plusieurs raisons. PHP est un langage de programmation largement utilisé pour le développement web backend en raison de sa flexibilité et de son intégration simple avec les serveurs web. Il est également bien supporté par des frameworks et outils qui facilitent le développement d'API comme celle que nous créons.

Quant à MySQL, il s'agit d'un système de gestion de base de données relationnelle robuste, performant et très populaire. MySQL s'intègre naturellement avec PHP, offrant ainsi une solution complète pour stocker et gérer les données. De plus, MySQL est open-source et dispose d'une vaste communauté, ce qui garantit un soutien continu et des ressources en cas de besoin.

## Instructions pour exécuter le projet
1. Clonez le dépôt.
2. Installez les dépendances avec Composer.
3. Configurez votre serveur web pour pointer vers le dossier `public`.
4. L'API repond a l'url:http://localhost:8080/projects/projetTestYello/api.php 
5. Pour recuperer,supprimer ou mettre a jour un cour specifique : http://localhost:8080/projects/projetTestYello/api.php/courses?id=(numID) (sur postman ou autre)
6. Pour executer les testes unitaires on se positionnne sur la racine du projet et on tape la commande suivante: ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/CoursesApiTest.php
il faut biensur installer phpUnit avant.

## Configuration de la base de données

1. Importez le fichier `education_plateform.sql` dans votre gestionnaire de base de données pour créer la structure.
2. Copiez le fichier `db.php` et remplissez les informations de connexion.


## Dépendances
- PHP  8.2.4
- Composer v2.8.1
- phpUnit v10