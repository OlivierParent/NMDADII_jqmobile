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

class CourseControllerRest extends \Ahs\ControllerRestAbstract
{
    public function indexAction()
    {
        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_OK)
             ->setBody(__METHOD__);
    }

    public function deleteAction()
    {
        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_OK)
             ->setBody(__METHOD__);
    }

    public function getAction()
    {
        $args = \Ahs\Route::getArgs();
        $name = isset($args['name']) ? $args['name'] : '';
        $courseMapper = new \App\Model\CourseMapper();
        $courses = $courseMapper->readAllLike($name);

        $view = $this->getView();
        if (empty($courses)) {
            $view->setResponseCode(\Ahs\Http::STATUS_CODE_NO_CONTENT);
        } else {
            foreach ($courses as $key => $course) {
                $courses[$key] = $course->toArray();
            }
            $view->setResponseCode(\Ahs\Http::STATUS_CODE_OK)
                 ->setContentType(\Ahs\Http::CONTENT_TYPE_JSON)
                 ->setBody($courses);
        }
    }

    public function headAction()
    {
        $view = $this->getView();
        $view->setResponseCode(\Ahs\Http::STATUS_CODE_NO_CONTENT)
             ->setBody(__METHOD__);
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
