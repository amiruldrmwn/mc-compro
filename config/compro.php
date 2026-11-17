<?php

/*
 * Mudah Company Profile settings that come from the container's environment. On MudahCloud
 * these are set by the app template on Easypanel when a customer buys the app.
 */
return [

    // The first admin account, created on boot when the site has no users yet.
    'admin' => [
        'name' => env('ADMIN_NAME', 'Admin'),
        'email' => env('ADMIN_EMAIL'),
        'password' => env('ADMIN_PASSWORD'),
    ],

    // MudahCloud AI Gateway (OpenAI compatible).
    'ai' => [
        'base_url' => env('AI_BASE_URL'),
        'api_key' => env('AI_API_KEY'),
        'model' => env('AI_MODEL', 'deepseek-v4-flash'),
    ],

];
