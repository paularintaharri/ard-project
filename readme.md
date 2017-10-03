<p align="center"><img src="https://laravel.com/assets/img/components/logo-homestead.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/homestead"><img src="https://travis-ci.org/laravel/homestead.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/homestead"><img src="https://poser.pugx.org/laravel/homestead/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/homestead"><img src="https://poser.pugx.org/laravel/homestead/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/homestead"><img src="https://poser.pugx.org/laravel/homestead/license.svg" alt="License"></a>
</p>

## Introduction

Laravel Homestead is an official, pre-packaged Vagrant box that provides you a wonderful development environment without requiring you to install PHP, a web server, and any other server software on your local machine. No more worrying about messing up your operating system! Vagrant boxes are completely disposable. If something goes wrong, you can destroy and re-create the box in minutes!

Homestead runs on any Windows, Mac, or Linux system, and includes the Nginx web server, PHP 7.1, MySQL, Postgres, Redis, Memcached, Node, and all of the other goodies you need to develop amazing Laravel applications.

Official documentation [is located here](https://laravel.com/docs/homestead).

## How To Configure the Project After Checkout

1. In the project's root folder on run `bash init.sh`
2. Go to Tools -> Vagrant -> Up
3. Change the folder mapping in Homestead.yaml
4. Go to Tools -> Vagrant -> Reload
5. Go to Tools -> Vagrant -> Provision
6. Go to Tools -> Start SSH session and select Vagrant at /Users/...
7. Navigate to /home/vagrant/Code/Laravel
8. Install dependencies by running `composer update` from command line
9. Create development environment by copying the Laravel example env `cp .env.example .env`
10. Generate the app key by running `php artisan key:generate`
11. Navigate to homestead.app and see that it works!
