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
        $request = trim(str_replace(array('/' . 'index.php', PATH_WEBROOT), '', $_SERVER['REQUEST_URI'] ), '/');
        $request = explode('/', $request);

        // Controllernaam
        if (isset($request[0])) {
            Route::setController($request[0]);
        }

        // Actionnaam
        if (isset($request[1])) {
            Route::setAction($request[1]);
        }

        // Argumenten opslaan in array met key-valueparen
        $count = count($request);
        if (2 < $count) {
            $args = [];
            for ($i = 2; $i < $count; $i++) {
				if ($i % 2  == 0) {
					// Key
					$args[$request[$i]] = null;
				} else {
					// Key => Value
					$args[$request[$i - 1]] = $request[$i];
				}
			}
            Route::setArgs($args);
        }

        $controllerClass   = '\\App\\Controller\\' . ucfirst(Route::getController()) . 'Controller';
        $controllerAction = Route::getAction() . 'Action';

        $controller = new $controllerClass;
        $controller->$controllerAction();
    }
}
