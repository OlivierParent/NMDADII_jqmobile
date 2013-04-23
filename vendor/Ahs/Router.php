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

class Router
{
    const NAME_SERVICE = 'service';

    const NAME_SUFFIX_ACTION          = 'Action';
    const NAME_SUFFIX_CONTROLLER      = 'Controller';
    const NAME_SUFFIX_CONTROLLER_REST = 'ControllerRest';

    /**
     * Is de route een RESTful service of gewoon.
     *
     * @var bool
     */
    protected $isRESTful = false;

    public static $e = null;

    public function __construct()
    {
        $request = str_replace([PATH_WEBROOT, basename($_SERVER['SCRIPT_NAME'])], '', $_SERVER['REQUEST_URI']);
        $request = trim($request, '/');
        $route = explode('/', $request);

        // Aantal items in de array $route tellen
        $count = count($route);

        // Controllernaam
        if (0 < $count) {
            if ($route[0] == self::NAME_SERVICE) {
                $this->isRESTful = true;
            } else {
                Route::setController($route[0]);
            }

            if (1 < $count) {
                if ($this->isRESTful) {
                    // Controllernaam en Actionnaam
                    Route::setController($route[1]);
                    Route::setActionRest();
                } else {
                    // Actionnaam
                    Route::setAction($route[1]);
                }

                // Argumenten opslaan in array met sleutel-waardeparen (key-value pairs)
                if (2 < $count) {
                    $args = [];
                    for ($i = 2; $i < $count; $i++) {
                        if ($i % 2 == 0) {
                            // Sleutel
                            $args[$route[$i]] = null;
                        } else {
                            // Sleutel => Waarde
                            $args[$route[$i - 1]] = $route[$i];
                        }
                    }
                    Route::setArgs($args);
                }
            }
        }

        try {
            $this->callControllerMethod();
        } catch (\Exception $e) {
            $this->callControllerMethodError($e);
        }
    }

    protected function callControllerMethod()
    {
        // Controllerklassenaam (met naamruimte) bepalen
        $controllerClass = '\\' . ApplicationAbstract::DIRECTORY_APP
                         . '\\' . ApplicationAbstract::DIRECTORY_CONTROLLER
                         . '\\' . ucfirst(Route::getController())
                         . ($this->isRESTful ? self::NAME_SUFFIX_CONTROLLER_REST : self::NAME_SUFFIX_CONTROLLER);
        // Actionmethodenaam
        $controllerMethod = Route::getAction() . self::NAME_SUFFIX_ACTION;

        // Controller instantiëren en Controller Action-methode aanroepen
        $controller = new $controllerClass;
        $controller->$controllerMethod();
    }

    /**
     * @param \Exception $e
     */
    protected function callControllerMethodError(\Exception $e)
    {
        self::$e = $e;
        Route::setController('error');
        if (!$this->isRESTful) {
            Route::setAction();
        }

        $this->callControllerMethod();
    }
}
