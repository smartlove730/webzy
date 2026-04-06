<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as OpenAI. This allows you to keep all of your secret keys in one
    | place, making it easy to change them without touching other parts of
    | your codebase. When deploying your application, remember to set the
    | corresponding environment variables (e.g. OPENAI_API_KEY) so these
    | values can be correctly loaded by Laravel's config helper.
    |
    */

    'openai' => [
        // Your OpenAI API key used for generating blog content. Set this in your .env file.
        'key' => env('OPENAI_API_KEY'),
    ],
];