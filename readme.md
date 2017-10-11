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

## API Documentation
The Speeding Ticket API uses Oauth2 for client and user authentication.
There are three API endpoints through which you can query for speeding tickets, manage your own account,
create or delete tickets and authorize your Oauth clients
### Getting started with API
Login or register to homestead.app.
From the user dashboard you can manage your Oauth clients and create personal access tokens.
You can authorize your client and request for Oauth-client tokens through our Oauth API endpoint.
You can test both authorization methods by making API calls with Postman.
### Example on how to use Oauth2 authorization with Postman:

Client-authentication:

- Authorization-URL: homestead.app/oauth/authorize
- Token-URL: homestead.app/oauth/token
- Callback-URL: "your.application.callback.url"
- ClientID: "your-application-client-id"
- ClientSecret: "your-application-client-secret"
- Scopes: Not used
- GrantType: Authorization Code

To use API in your application you need to add code below to your source code.

Making API calls

Call header needs

- Accept: application/json
- Authorization: Bearer "Personal-Access-Token"

### Example API calls
GET all the tickets:
- homestead.app/api/tickets

GET ticket with ticket id example:
- homestead.app/api/tickets/3

GET tickets coordinates with ticket id example:
- homestead.app/api/tickets/coordinates/3

GET all the tickets by city name example:
- homestead.app/api/tickets/city/Helsinki

GET all the tickets by latitude and longitude example:
- homestead.app/api/tickets/coord/lat=32lon=78

GET all the tickets by user id example:
- homestead.app/api/tickets/user/11

### User API

The API supports retrieving authenticated user's resources.
The base URL for user's resources is: `homestead.app/api/user`
To be able to make any calls to the User API, you first need to create a Personal Access Token.

GET API user's details, UPDATE user information or DELETE account:
- homestead.app/api/user

GET API user managed tickets:
- homestead.app/api/user/tickets

GET ticket by ID:
- homestead.app/api/user/tickets/{id}

POST new ticket:
- homestead.app/api/user/tickets

DELETE ticket by ID:
- homestead.app/api/user/tickets/{id}