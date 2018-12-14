<?php

namespace Drupal\devinshop\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Database extends ControllerBase
{

    /**
     * @var Connection $database
     *   Database connection.
     */
    protected $database;

    /**
     * @return Connection
     */
    private function getDatabaseConnection()
    {
        return $this->database;
    }


    /**
     * Database constructor.
     *   @param Connection $database
     */
    public function __construct(Connection $database)
    {
        $this->database = $database;
    }

    /**
     * @param ContainerInterface $container
     * @return static
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('database')
        );
    }

    /**
     * Insert data to database table.
     *
     * @param $table
     * @param $fields
     */
    public function insert($table, $fields)
    {
        $this->getDatabaseConnection()->insert($table)->fields($fields)->execute();
    }
}
