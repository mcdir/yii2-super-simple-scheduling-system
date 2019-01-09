#!/usr/bin/env bash

# chmod -R 777 ./docker/mysql/data/db

./composer install -o

if docker ps | grep yii2-super-simple-scheduling-system-mysql
  then docker exec yii2-super-simple-scheduling-system-mysql mysql -u root -proot -e "CREATE DATABASE IF NOT EXISTS yii2_super_simple_scheduling_system_mysql CHARACTER SET utf8 COLLATE utf8_unicode_ci;"
  else echo "NOT yii2_super_simple_scheduling_system_mysql FOUND"
  docker exec yii2-super-simple-scheduling-system-mysql sh -c "/usr/bin/mysql_tzinfo_to_sql /usr/share/zoneinfo  | mysql -uroot -proot mysql"
fi

docker exec yii2-super-simple-scheduling-system-php mkdir -p /var/www/html/web/assets /var/www/html/runtime /var/www/html/runtime/cache
docker exec yii2-super-simple-scheduling-system-php chmod -R 777 /var/www/html/web/assets /var/www/html/runtime /var/www/html/runtime/cache
docker exec yii2-super-simple-scheduling-system-php /var/www/html/yii  migrate/fresh --interactive=0
docker exec yii2-super-simple-scheduling-system-php /var/www/html/yii  fixture/load "*" --interactive=0

