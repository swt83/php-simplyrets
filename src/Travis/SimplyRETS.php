<?php

namespace Travis;

class SimplyRETS
{
    /**
     * Magic method for handling API methods.
     *
     * @param   string  $method
     * @param   array   $args
     * @return  array
     */
    public static function __callStatic($method, $args)
    {
        // capture username/password
        $api_key = ex($args[0], 'api_key');
        $api_secret = ex($args[0], 'api_secret');
        unset($args[0]['api_key'], $args[0]['api_secret']); // strip from payload

        // catch error...
        if (!$api_key or !$api_secret) trigger_error('Username and password required.');

        // detect if requesting specific listing
        $mls_id = ex($args[0], 'mls_id');
        unset($args[0]['mls_id']); // strip from payload

        // build uri
        $uri = strtolower($method).($mls_id ? '/'.$mls_id : '');

        // build payload
        $payload = http_build_query($args[0]);

        // build endpoint
        $endpoint = 'https://api.simplyrets.com/'.$uri.'?'.$payload;

        // make headers
        $headers = [
            'accept:application/json', // will use latest repsonse format
            #'accept:application/vnd.simplyrets-v0.1+json', // will use specific response format (stable)
        ];

        // setup curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, "$api_key:$api_secret");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
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
        return json_decode($response);
    }
}