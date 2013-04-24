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

use Ahs\ControllerRestAbstract;
use Ahs\Http;
use Ahs\Route;
use App\Model\Schedule;
use App\Model\ScheduleMapper;

class ScheduleControllerRest extends ControllerRestAbstract
{
    public function indexAction()
    {
        $view = $this->getView();
        $view->setResponseCode(Http::STATUS_CODE_OK)
             ->setBody(__CLASS__ . ' ' .__METHOD__);
    }

    public function deleteAction()
    {
        $data = Route::getArgs();
        $schedule = new Schedule($data);
        $scheduleMapper = new ScheduleMapper();
        $result = $scheduleMapper->delete($schedule);
        if ($result) {
            $view = $this->getView();
            $view->setResponseCode(Http::STATUS_CODE_OK);
        }
    }

    public function getAction()
    {
        $view = $this->getView();
        $view->setResponseCode(Http::STATUS_CODE_OK)
             ->setBody(__CLASS__ . ' ' .__METHOD__);
    }

    public function headAction()
    {
        $view = $this->getView();
        $view->setResponseCode(Http::STATUS_CODE_NO_CONTENT);
    }

    public function postAction()
    {
        $view = $this->getView();
        $view->setResponseCode(Http::STATUS_CODE_CREATED)
             ->setBody(__CLASS__ . ' ' .__METHOD__);
    }

    public function putAction()
    {
        $view = $this->getView();
        $view->setResponseCode(Http::STATUS_CODE_CREATED)
             ->setBody(__CLASS__ . ' ' .__METHOD__);
    }
}
