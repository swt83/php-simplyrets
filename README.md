# SimplyRETS

A PHP library for working w/ the [SimplyRETS](https://docs.simplyrets.com/) API.

## Install

Normal install via Composer.

## Usage

Make a method request and pass all params as a single array.

```php
use Travis\SimplyRETS;

// make a request for multiple listings
$response = SimplyRETS::properties([
	'api_key' => 'simplyrets', // required
	'api_secret' => 'simplyrets', // required
	'status' => 'active',
]);

// make a request for a specific listing
$response = SimplyRETS::properties([
	'api_key' => 'simplyrets', // required
	'api_secret' => 'simplyrets', // required
	'mls_id' => '1234',
]);
```

For more information about available methods and optional search parameters consult the [documentation](https://docs.simplyrets.com/).