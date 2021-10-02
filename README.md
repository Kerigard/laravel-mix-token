# LaravelMixToken

<p align="center">
  <a href="https://github.com/Kerigard/laravel-mix-token/actions"><img src="https://github.com/Kerigard/laravel-mix-token/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/Kerigard/laravel-mix-token"><img src="https://img.shields.io/packagist/dt/Kerigard/laravel-mix-token" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/Kerigard/laravel-mix-token"><img src="https://img.shields.io/packagist/v/Kerigard/laravel-mix-token" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/Kerigard/laravel-mix-token"><img src="https://img.shields.io/packagist/l/Kerigard/laravel-mix-token" alt="License"></a>
</p>

Tracking changes in files created with Laravel Mix for SPA applications.

## Installation

Via Composer

``` bash
composer require kerigard/laravel-mix-token
```

## Usage

You should add middleware to your `api` middleware group within your application's `app/Http/Kernel.php` file:

``` php
'api' => [
    \Kerigard\MixToken\SetMixHeader::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

Add token in an HTML `meta` tag:

``` html
<meta name="mix-token" content="{{ mix_token() }}">
```

To find out if there are changes, you need to add the `X-Requested-With` header to all requests to the server and check if there is a difference between the token in the `meta` tag and the `X-Mix-Token` header when answering.

``` js
import axios from 'axios'

const mixToken = document.head.querySelector('meta[name=mix-token]').content
const instance = axios.create({
  headers: { 'X-Requested-With': 'XMLHttpRequest' }
})

instance.interceptors.response.use(
  (response) => {
    if (response.headers['x-mix-token'] !== undefined && response.headers['x-mix-token'] != mixToken) {
      console.log('Mix manifest has been changed. Ask the user to refresh the page')
    }

    return response
  },
)
```

## License

MIT. Please see the [LICENSE FILE](LICENSE.md) for more information.
