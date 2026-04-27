<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configuration du service SSO ANPI-Gabon
    |--------------------------------------------------------------------------
    | Ces valeurs sont injectées automatiquement dans config('services.anpi')
    | pour être utilisées par le driver Socialite.
    */

    'client_id'     => env('ANPI_SSO_CLIENT_ID'),
    'client_secret' => env('ANPI_SSO_CLIENT_SECRET'),
    'redirect'      => env('ANPI_SSO_REDIRECT', env('APP_URL') . '/auth/anpi/callback'),
    'base_uri'      => env('ANPI_SSO_URL', 'https://investingabon.ga'),

    /*
    |--------------------------------------------------------------------------
    | Scopes demandés par défaut
    |--------------------------------------------------------------------------
    | Scopes disponibles : profile, email, investor, partner, admin
    */

    'scopes' => ['profile', 'email'],

    /*
    |--------------------------------------------------------------------------
    | Durée de vie des tokens (secondes)
    |--------------------------------------------------------------------------
    */

    'token_ttl'   => env('ANPI_SSO_TOKEN_TTL', 86400),    // 24h
    'refresh_ttl' => env('ANPI_SSO_REFRESH_TTL', 2592000), // 30j

];
