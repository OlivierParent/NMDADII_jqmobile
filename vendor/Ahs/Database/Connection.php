<?php
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                        aaaAAaaa            HHHHHH                          *
 *                     aaAAAAAAAAAAaa         HHHHHH                          *
 *                    aAAAAAAAAAAAAAAa        HHHHHH                          *
 *                   aAAAAAAAAAAAAAAAAa       HHHHHH                          *
 *                   aAAAAAa    aAAAAAA                                       *
 *                   AAAAAa      AAAAAA                                       *
 *                   AAAAAa      AAAAAA                                       *
 *                   aAAAAAa     AAAAAA                                       *
 *                    aAAAAAAaaaaAAAAAA       HHHHHH                          *
 *                     aAAAAAAAAAAAAAAA       HHHHHH                          *
 *                      aAAAAAAAAAAAAAA       HHHHHH                          *
 *                         aaAAAAAAAAAA       HHHHHH                          *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *      a r t e v e l d e  u n i v e r s i t y  c o l l e g e  g h e n t      *
 *                                                                            *
 *                                                                            *
 *                                 MEMBER OF GHENT UNIVERITY ASSOCIATION      *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
 *
 * Klasse voor databaseconnectie. De klasse gedraagt zich gelijkaardig aan een
 * singleton (Singleton Design Pattern).
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2013 Artevelde University College Ghent
 */

namespace Ahs\Database;

use Ahs\ApplicationAbstract;

class Connection
{
    /**
     * Instantie van de databaseconnectie.
     *
     * @staticvar \PDO
     */
    protected static $instance;

    /**
     * Magische methode voor de constructor. Hier is deze methode protected, omdat
     * instatiëren via getInstance() moeten gebeuren
     *
     * @throws \ErrorException
     */
    protected function __construct()
    {
        throw new \ErrorException('Creating instance of class disallowed, use <strong>' . get_called_class() . '::getInstance()</strong> instead.');
    }

    /**
     * Magische methode aangeroepen tijdens klonen. Moet klonen voorkomen.
     *
     * @throws \ErrorException
     */
    protected function __clone()
    {
        throw new \ErrorException('Cloning of <strong>' . get_called_class() . '</strong> object disallowed.');
    }

    /**
     * Geeft de instantie terug, en maakt zo nodig een instantie aan.
     *
     * @return \PDO
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::createInstance();
        }

        return self::$instance;
    }

    /**
     * Haalt de configuratie op en maakt een connectie met de databaseserver.
     *
     * @return bool
     * @throws \ErrorException
     */
    protected static function createInstance()
    {
        $filename = PATH_CONFIG . ApplicationAbstract::FILE_CONFIG_DATABASE;
        if (file_exists($filename)) {
            $config = parse_ini_file($filename); // Zie: http://php.net/manual/en/function.parse-ini-file.php
            // 'Data Source Name' samenstellen
            $config['dsn'] = $config['dsn.driver'] . ':';
            if (!empty($config['dsn.host'  ]) ) {
                $config['dsn'] .= 'host=' . $config['dsn.host'] . ';';
            }
            if (!empty($config['dsn.port'  ]) ) {
                $config['dsn'] .= 'port=' . $config['dsn.port'] . ';';
            }
            if (!empty($config['dsn.schema']) ) {
                $config['dsn'] .= 'dbname=' . $config['dsn.schema'] . ';';
            }
            try {
                self::$instance = new \PDO($config['dsn'     ],
                                           $config['username'],
                                           $config['password'],
                                          @$config['options' ]);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                throw new \ErrorException('Cannot connect to database (<em>' . $e->getMessage() . '</em>)');
            }

        } else {
            throw new \ErrorException("File <strong>{$filename}</strong> does not exist");
        }

        return true;
    }

}
