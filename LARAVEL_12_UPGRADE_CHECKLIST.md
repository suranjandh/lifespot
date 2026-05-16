# Laravel 12 Upgrade Merge Checklist

> [!IMPORTANT]
> This PR is **not merge-ready** until `composer.lock` is regenerated and committed from an environment with Packagist access.

## Required maintainer validation

Run these commands locally before merging or deploying:

```bash
composer update --with-all-dependencies
composer show laravel/framework phpunit/phpunit nesbot/carbon fruitcake/laravel-debugbar spatie/laravel-activitylog
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan migrate --pretend
php artisan test
```

## Expected resolved versions

- PHP: 8.2+
- laravel/framework: 12.x
- phpunit/phpunit: 11.x
- nesbot/carbon: 3.x
- fruitcake/laravel-debugbar: 4.2.x or compatible
- spatie/laravel-activitylog: 4.x

## Merge gate

- [ ] `composer.lock` has been regenerated with Laravel 12-compatible dependencies.
- [ ] The regenerated `composer.lock` is committed to this PR.
- [ ] The expected package versions above have been verified with `composer show`.
- [ ] Config, route, and cache clear commands pass.
- [ ] `php artisan migrate --pretend` passes.
- [ ] `php artisan test` passes.
