<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * @return \Doctrine\DBAL\Connection
 */
function getConnection()
{
    static $connection;

    if ($connection) {
        return $connection;
    }

    $params = array(
        'driver' => 'pdo_sqlite',
        'memory' => true
    );

    $connection = \Doctrine\DBAL\DriverManager::getConnection($params);
    $fromSchema = $connection->getSchemaManager()->createSchema();

    $toSchema = new \Doctrine\DBAL\Schema\Schema();
    $table = $toSchema->createTable('psx_filter');
    $table->addColumn('id', 'integer', array('length' => 10, 'autoincrement' => true));
    $table->addColumn('userId', 'integer', array('length' => 10));
    $table->addColumn('title', 'string', array('length' => 32));
    $table->addColumn('date', 'datetime');
    $table->setPrimaryKey(array('id'));

    $queries = $fromSchema->getMigrateToSql($toSchema, $connection->getDatabasePlatform());
    foreach ($queries as $query) {
        $connection->query($query);
    }

    return $connection;
}

