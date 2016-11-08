# ReCAPTCHA

A PHP library for working w/ the [Google reCAPTCHA API](https://developers.google.com/recaptcha/docs/verify).

## Install

Normal install via Composer.

## Usage

```php
use Travis\Recaptcha;

$response = Recaptcha::verify($secret_key, $token);
```

The ``$secret_key`` is provded by the [API registration](https://www.google.com/recaptcha/admin#list) page, while the ``$token`` value is provided by the form post data.

For more information, or questions about implementation, consult the [documentation](https://developers.google.com/recaptcha/docs/verify).