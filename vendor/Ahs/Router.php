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
    public function __construct()
    {
        $request = str_replace(array(PATH_WEBROOT, '/index.php'), '', $_SERVER['REQUEST_URI']);
        $request = trim($request, '/');
        $route = explode('/', $request);

        // Aantal items in de array $route tellen
        $count = count($route);

        // Controllernaam
        if (0 < $count) {
            Route::setController($route[0]);

            // Actionnaam
            if (1 < $count) {
                Route::setAction($route[1]);

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

        // Controllerklassenaam (met naamruimte) en Actionmethodenaam bepalen
        $controllerClass  = '\\App\\Controller\\' . ucfirst(Route::getController()) . 'Controller';
        $controllerAction = Route::getAction() . 'Action';

        // Controller instantiëren en Controller Action aanroepen
        $controller = new $controllerClass;
        $controller->$controllerAction();
    }
}
