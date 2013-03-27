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

abstract class ControllerAbstract
{
    /**
     * @var \Ahs\Session
     */
    protected $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    abstract public function indexAction();

    /**
     * @return \Ahs\View
     */
    protected function getView()
    {
        return new \Ahs\View();
    }

    /**
     *
     * @param type $path
     */
    protected function redirect($path)
    {
        /**
        * Stuur de browser door naar een andere pagina.
        *
        * @static
        * @param string $path
        */

        // OPGELET: moet altijd voor de output - naar HTML bijv. - staan, want anders is er reeds een HTTP-header doorgestuurd.
        // Zie: http://www.php.net/manual/en/function.header.php
        @header('Location: ' . $path) && exit; // @ vangt de foutmelding 'headers already sent' op zodat de code niet stopt.
    }
}
