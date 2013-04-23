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

namespace App\Controller;

class ErrorControllerRest extends \Ahs\ControllerRestAbstract
{
    public function indexAction()
    {
        $this->exception();
    }

    public function getAction()
    {
        $this->exception();
    }

    public function headAction()
    {
        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_NOT_IMPLEMENTED);
    }

    public function deleteAction()
    {
        $this->exception();
    }

    public function postAction()
    {
        $this->exception();
    }

    public function putAction()
    {
        $this->exception();
    }

    /**
     * Exception Message
     */
    public function exception()
    {
        $body = ['error' => \Ahs\Router::$e];

        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_NOT_IMPLEMENTED)
             ->setContentType( \Ahs\Http::CONTENT_TYPE_JSON)
             ->setBody($body);
    }
}
