<?php

return [
    'class' => 'yii\db\Connection',
// docker
    'dsn' => 'mysql:host=mysql;dbname=yii2_super_simple_scheduling_system_mysql',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',

// local
//    'dsn' => 'mysql:host=localhost;dbname=yii2_super_simple_scheduling_system_mysql',
//    'username' => 'root',
//    'password' => 'root',
//    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
