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

class StudentController extends \Ahs\ControllerAbstract
{
    public function indexAction()
    {
        die(__METHOD__);
    }

    /**
     *
     * @return type
     */
    public function loginAction()
    {
        if (isset($_POST) && isset($_POST['button-login']) ) {
            $student = new \App\Model\Student($_POST, false, false);

            try {
                $studentMapper = new \App\Model\StudentMapper();
                $studentMapper->hashCredentials($student);
                $student = $studentMapper->readAuthenticate($student);
            } catch (\Exception $e) {
                die ($e->getMessage() );
            } catch (\ErrorException $e) {
                die ($e->getMessage() );
            }

            if ($student->getId() !== null) {
                $this->session->create('student', $student);
                return $this->redirect(PATH_WEBROOT . '/calendar');
            }
        }

        return $view = $this->getView();
    }

    /**
     *
     * @return type
     */
    public function registerAction()
    {
        if (isset($_POST) && isset($_POST['button-register']) ) {
            $student = new \App\Model\Student($_POST);

            try {
                $studentMapper = new \App\Model\StudentMapper();
                $studentMapper->create($student);
            } catch (\Exception $e) {
                die ($e->getMessage() );
            } catch (\ErrorException $e) {
                die ($e->getMessage() );
            }

            if ($student->getId() !== null) {
                return $this->redirect(PATH_WEBROOT);
            }
        }

        return $view = $this->getView();
    }

    /**
     *
     * @return type
     */
    public function logoutAction()
    {
        $this->session->destroy();

		return $this->redirect(PATH_WEBROOT);
    }
}
