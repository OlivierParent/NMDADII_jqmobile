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
     * Standaard Controller.
     */
    const DEFAULT_CONTROLLER        = 'index';

    /**
     * Standaaard Controller Action.
     */
    const DEFAULT_CONTROLLER_ACTION = 'index';

    /**
     * Naam van de Controller Action.
     *
     * @var string
     */
    static protected $action = self::DEFAULT_CONTROLLER_ACTION;

    /**
     * Naam van de Controller.
     *
     * @var string
     */
    static protected $controller = self::DEFAULT_CONTROLLER;

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
    static public function setAction($action = self::DEFAULT_CONTROLLER_ACTION)
    {
        self::$action = empty($action) ? self::DEFAULT_CONTROLLER_ACTION : $action;
    }

    /**
     * Setter voor de naam van de Controller Action van een RESTful Controller.
     */
    static public function setActionRest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        switch ($requestMethod) {
            case Http::REQUEST_METHOD_DELETE:
            case Http::REQUEST_METHOD_GET:
            case Http::REQUEST_METHOD_HEAD:
            case Http::REQUEST_METHOD_POST:
            case Http::REQUEST_METHOD_PUT:
                $action = strtolower($requestMethod);
                self::setAction($action);
                break;
            default:
                self::setAction(self::DEFAULT_CONTROLLER_ACTION);
                break;
        }
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
    static public function setController($controller = self::DEFAULT_CONTROLLER)
    {
        self::$controller = empty($controller) ? self::DEFAULT_CONTROLLER : $controller;
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
