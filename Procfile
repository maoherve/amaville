release: php bin/console cache:clear
release: php bin/console make:migration
release: php bin/console doctrine:migrations:migrate
web: heroku-php-apache2 public/