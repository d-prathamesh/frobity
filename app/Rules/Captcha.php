<?php

namespace App\Rules;

use GuzzleHttp\Client;

class ValidRecaptcha implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //Validate ReCaptcha
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/'
        ]);
$response = $client->post('siteverify', [
            'query' => [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                'response' => $value
            ]
        ]);
return json_decode($response->getBody())->success;
    }
/**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Incorrect ReCaptcha.';
    }
}
