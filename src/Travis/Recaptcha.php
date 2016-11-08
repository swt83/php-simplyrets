<?php

namespace Travis;

class Recaptcha
{
    /**
     * Run the API request.
     *
     * @param   string  $secret_key
     * @param   string  $token
     * @return  boolean
     */
    public static function verify($secret_key, $token)
    {
        // set endpoint
        $endpoint = 'https://www.google.com/recaptcha/api/siteverify';

        // make payload
        $payload = [
            'secret' => $secret_key,
            'response' => $token,
        ];

        // setup curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $response = curl_exec($ch);

        // catch error...
        if (curl_errno($ch))
        {
            // report
            #$errors = curl_error($ch);

            // close
            curl_close($ch);

            // return false
            return false;
        }

        // close
        curl_close($ch);

        // decode response
        $response = json_decode($response);
        xx($response);
        // return response success value
        return ex($response, 'success', false);
    }
}