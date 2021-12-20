release: php bin/console cache:clear && php bin/console cache:warmup
release: php bin/console doctrine:schema:update --force
web: heroku-php-apache2 public/