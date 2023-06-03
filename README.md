# Remise à niveau HTTP - Etudiants 

Ce repository contient le code source de l'application de démonstration utilisée pour le cours de remise à niveau HTTP, le sujet est disponible dans `instructions-students`.

Voir le sujet : [instructions-students/README.md](instructions-students/README.md)

> 🔥 **Penser à bien modifier le contenu avec l'URL du serveur déployé** 🔥

## Installation

Pour faire fonctionner ce sujet il faudra d'abord déployer Laravel + une base de donnée. 
1. Dupliquer .env.example et éditer .env avec les bonnes informations de connexion à la base de donnée
2. Installer les dépendances PHP avec composer : `composer install`
3. (Si besoin) Générer une clé d'application : `php artisan key:generate`
4. Lancer les migrations : `php artisan migrate`
5. Lancer le serveur : `php artisan serve`

> J'utilisais personnellement Heroku qui permet de déployer une application Laravel en quelques minutes, mais il est possible d'utiliser n'importe quel autre hébergeur. A tester en herbergeur cloud gratuit : Render.

## Utilisation
Les étudiants ont simplement à lire les instructions, la construction des phrases est volontairement organique et pas forcément claire techniquement pour les guider dans la recherche de la bonne réponse.

### Par exemple :
> Le domaine de l'API est herokuapp.com le schéma d'url est https et le sous domaine est m1-mds-web-simple-api-tester.

Au lieu de simplement leur donner l'URL de l'API, on leur donne des indices pour qu'ils comprennent comment fonctionne une URL et comment la décomposer.

# Laravel

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**
- **[Romega Software](https://romegasoftware.com)**