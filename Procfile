release: php bin/console cache:clear && php bin/console cache:warmup
release: php bin/console doctrine:migrations:migrate
web: $(composer config bin-dir)/heroku-php-apache2 public/