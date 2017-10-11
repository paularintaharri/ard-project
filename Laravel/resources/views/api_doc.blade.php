@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Speeding Ticket API</h1>
                <h2>API Documentation</h2>
                <p>The Speeding Ticket API uses Oauth2 for client and user authentication.
                    There are three API endpoints through which you can query for speeding
                    tickets, manage your own account, create or delete tickets and authorize
                    your Oauth clients</p>
                <h3>Getting started with API</h3>
                <p>Login or register to homestead.app.
                    From the user dashboard you can manage your Oauth clients and create personal access tokens.
                    You can authorize your client and request for Oauth-client tokens through our Oauth API endpoint.
                    You can test both authorization methods by making API calls with Postman.</p>
                <h3>Example on how to use Oauth2 authorization with Postman:</h3>
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
                <p>GET all the tickets:<br>
                    homestead.app/api/tickets<br><br>
                    GET ticket with ticket id example:<br>
                    homestead.app/api/tickets/3<br><br>
                    GET tickets coordinates with ticket id example:<br>
                    homestead.app/api/tickets/coordinates/3<br><br>
                    GET all the tickets by city name example:<br>
                    homestead.app/api/tickets/city/Helsinki<br><br>
                    GET all the tickets by latitude and longitude example:<br>
                    homestead.app/api/tickets/coord/lat=32lon=78<br><br>
                    GET all the tickets by user id example:<br>
                    homestead.app/api/tickets/user/11
                </p>
                <h3>User API</h3>
                <p>The API supports retrieving authenticated user's resources.<br>
                The base URL for user's resources is: <code>homestead.app/api/user</code><br>
                To be able to make any calls to the User API, you first need to create a Personal Access Token.</p>
                <p>GET API user's details, UPDATE user information or DELETE account:<br>
                    homestead.app/api/user<br><br>
                    GET API user managed tickets:<br>
                    homestead.app/api/user/tickets<br><br>
                    GET ticket by ID:<br>
                    homestead.app/api/user/tickets/{id}<br><br>
                    POST new ticket:<br>
                    homestead.app/api/user/tickets<br><br>
                    DELETE ticket by ID:<br>
                    homestead.app/api/user/tickets/{id}<br><br>
                </p>

            </div>
        </div>
    </div>
@endsection