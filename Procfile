release: php bin/console cache:clear && php bin/console cache:warmup
release: php bin/console doctrine:migrations:migrate --write-sql
web: heroku-php-apache2 public/