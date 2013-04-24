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

    /**
     * Elke Controller moet de methode indexAction implementeren.
     */
    abstract public function indexAction();

    /**
     * @return \Ahs\View
     */
    protected function getView()
    {
        return new View();
    }

    /**
     * Stuur de browser door naar een andere pagina.
     *
     * OPGELET: een redirect moet altijd gebeuren voordat er output verstuurd
     * wordt. Als er output verstuurd wordt, dan wordt de HTTP-header reeds
     * verstuurd.
     *
     * @param string $path
     */
    protected function redirect($path)
    {
        /**
         * De @ operator vangt een eventuele foutmelding 'headers already sent'
         * op zodat de code niet stopt.
         */
        @header('Location: ' . $path) && exit;
    }
}
