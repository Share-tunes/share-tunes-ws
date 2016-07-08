php bin/console doctrine:schema:drop --force
php bin/console doctrine:schema:create
php bin/console doctrine:fixtures:load

php bin/console oauth:client:create client1 www.client1.com password