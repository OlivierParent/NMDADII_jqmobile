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
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2013 Artevelde University College Ghent
 */

namespace Ahs;

class Route
{
    /**
     * Naam van de Controller Action.
     *
     * @var string
     */
    static protected $action = 'index';

    /**
     * Naam van de Controller.
     *
     * @var string
     */
    static protected $controller = 'index';


    /**
     * Argumenten.
     *
     * @var array
     */
    static protected $args = [];


    /**
     * Getter voor de naam van de Controller Action.
     *
     * @return string Naam van de Controller Action.
     */
    static public function getAction()
    {
        return self::$action;
    }

    /**
     * Setter voor de naam van de Controller Action.
     *
     * @param string $action Naam van de Controller Action.
     */
    static public function setAction($action)
    {
        self::$action = empty($action) ? 'index' : $action;
    }

    /**
     * Haal de naam van de Controller op.
     *
     * @return string Naam van de Controller.
     */
    static public function getController()
    {
        return self::$controller;
    }

    /**
     * Zet de naam van de Controller.
     *
     * @param string $controller Naam van de Controller.
     */
    static public function setController($controller)
    {
        self::$controller = empty($controller) ? 'index' : $controller;
    }

    /**
     * Haal de array met argumenten op.
     *
     * @return array
     */
    static public function getArgs()
    {
        return self::$args;
    }

    /**
     * Zet de array van argumenten.
     *
     * @param array $args
     */
    static public function setArgs(array $args)
    {
        self::$args = $args;
    }
}
