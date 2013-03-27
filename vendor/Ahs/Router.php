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

        if (isset($request[0])) {
            Route::setController($request[0]);
        }
        if (isset($request[1])) {
            Route::setAction($request[1]);
        }

        $controllerClass   = '\\App\\Controller\\' . ucfirst(Route::getController()) . 'Controller';
        $controllerAction = Route::getAction() . 'Action';

        $controller = new $controllerClass;
        $controller->$controllerAction();
    }
}
