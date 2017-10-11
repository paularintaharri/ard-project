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

<h2>API Documentation</h2>
                <h3>Getting started with API</h3>
                <p>Login to service and request for Oauth-client and you will receive client secret key.
                    With that key you can make API calls with Postman. Example on how to add Oauth to Postman below</p>
                <p>Client-authentication:<br>
                    Authorization-URL: homestead.app/oauth/authorize<br>
                    Token-URL: homestead.app/oauth/token<br>
                    Callback-URL: "your.application.callback.url"<br>
                    ClientID: "your-application-client-id"<br>
                    ClientSecret: "your-application-client-secret"<br>
                    Scopes: Not used<br>
                    GrantType: Authorization Code<br>
                </p>
                <p>To use API in your application you need to add code below to your source code.<br>
                    Making API calls<br>
                    Call header needs</p>
                <code>Accept: application/json</code><br>
                <code>Authorization: Bearer "Personal-Access-Token"</code>
                <h3>Example API calls</h3>
                <p>Get all the tickets:<br>
                    homestead.app/api/tickets<br><br>
                    Get ticket with ticket id example:<br>
                    homestead.app/api/tickets/3<br><br>
                    Get tickets coordinates with ticket id example:<br>
                    homestead.app/api/tickets/coordinates/3<br><br>
                    Get all the tickets by city name example:<br>
                    homestead.app/api/tickets/city/Helsinki<br><br>
                    Get all the tickets by latitude and longitude example:<br>
                    homestead.app/api/tickets/coord/lat=32lon=78<br><br>
                    Get all the tickets by user id example:<br>
                    homestead.app/api/tickets/user/11
                </p>
