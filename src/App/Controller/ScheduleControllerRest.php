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

class ScheduleControllerRest extends \Ahs\ControllerRestAbstract
{
    public function indexAction()
    {
        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_OK)
             ->setBody(__METHOD__);
    }

    public function deleteAction()
    {
        $data = \Ahs\Route::getArgs();
        $schedule = new \App\Model\Schedule($data);
        $scheduleMapper = new \App\Model\ScheduleMapper();
        $result = $scheduleMapper->delete($schedule);
        if ($result) {
            $view = $this->getView();
            $view->setResponseCode(\Ahs\Http::STATUS_CODE_OK);
        }
    }

    public function getAction()
    {
        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_OK)
             ->setBody(__METHOD__);
    }

    public function headAction()
    {
        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_NO_CONTENT);
    }

    public function postAction()
    {
        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_CREATED)
             ->setBody(__METHOD__);
    }

    public function putAction()
    {
        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_CREATED)
             ->setBody(__METHOD__);
    }
}
