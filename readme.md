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

##API Documentation
###Getting started with API
Login to service and request for Oauth-client and you will receive client secret key.
With that key you can make API calls with Postman. Example on how to add Oauth to Postman below
Client-authentication:

Authorization-URL: homestead.app/oauth/authorize
Token-URL: homestead.app/oauth/token
Callback-URL: "your.application.callback.url"
ClientID: "your-application-client-id"
ClientSecret: "your-application-client-secret"
Scopes: Not used
GrantType: Authorization Code

To use API in your application you need to add code below to your source code.
Making API calls
Call header needs

Accept: application/json
Authorization: Bearer "Personal-Access-Token"

###Example API calls
Get all the tickets:
homestead.app/api/tickets

Get ticket with ticket id example:
homestead.app/api/tickets/3

Get tickets coordinates with ticket id example:
homestead.app/api/tickets/coordinates/3

Get all the tickets by city name example:
homestead.app/api/tickets/city/Helsinki

Get all the tickets by latitude and longitude example:
homestead.app/api/tickets/coord/lat=32lon=78

Get all the tickets by user id example:
homestead.app/api/tickets/user/11