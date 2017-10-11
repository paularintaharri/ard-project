@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Speeding Ticket API</h1>
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

            </div>
        </div>
    </div>
@endsection