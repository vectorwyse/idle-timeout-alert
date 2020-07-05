# Idle Timeout Alert
> A Laravel package for alerting idle sessions about to expire.

SESSION_LIFETIME is great but how is the user supposed to know when the session is about to expire due to inactivity, especially if it is a low value? When the session is about to expire, show a dialog so the user can choose not to be logged out.

## Installation

```sh
composer require vectorwyse/idle-timeout-alert
```

## Usage

### Disable "Remember Me" functionality

Step 1:
Add the following line to `app/User.php`:
```php
protected $rememberTokenName = false;
```

Step 2:
Remove the "Remember Me" checkbox from your login form

## Support Us
[Vectorwyse](https://vectorwyse.com) is a digital agency offering advisory and web development services. We love building things with Laravel and Vue.js, so when we have an opportunity to give back to the community, we're super excited! 

If you find this package useful, or if you would like us to build something for you, feel free to [drop us a line!](mailto:hello@vectorwyse.com)
