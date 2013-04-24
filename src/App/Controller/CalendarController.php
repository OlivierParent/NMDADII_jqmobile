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

use Ahs\ControllerAbstract;
use App\Model\CourseMapper;
use App\Model\Lecturer;
use App\Model\LecturerMapper;
use App\Model\RoomMapper;
use App\Model\Schedule;
use App\Model\ScheduleMapper;
use App\Model\TimeslotMapper;

class CalendarController extends ControllerAbstract
{
    public function indexAction()
    {
        $student = $this->session->read('student');

        $view = $this->getView();
        $view->addHeadScript($view->path('assets/js/calendar/index.js'));
        $view->student = $student;

        $scheduleMapper = new ScheduleMapper();
        $view->scheduleToday    = $scheduleMapper->readAllForStudentToday($student);
        $view->scheduleThisWeek = $scheduleMapper->readAllForStudent($student);
    }

    public function addAction()
    {
        if (isset($_POST) && isset($_POST['button-schedule'])) {
            $student = $this->session->read('student');

            $scheduleMapper = new ScheduleMapper();
            foreach ($_POST['timeslots'] as $timeslot) {
                $schedule = new Schedule([
                    'student'  => $student->getId(),
                    'course'   => $_POST['course'],
                    'timeslot' => $timeslot,
                    'room'     => $_POST['room'],
                ]);

                $scheduleMapper->create($schedule);
            }

            $courseMapper = new CourseMapper();
            foreach ($_POST['lecturers'] as $lecturer_id) {
                $lecturer = new Lecturer(['id' => $lecturer_id]);
                $courseMapper->createHasLecturer($schedule->getCourse(), $lecturer);
            }

            $this->redirect(PATH_WEBROOT . '/calendar');
        }
        $view = $this->getView();
        $view->addHeadScript($view->path('assets/js/calendar/add.js') );

        $courseMapper  = new CourseMapper();
        $view->courses = $courseMapper->readAll();

        $timeslotMapper  = new TimeslotMapper();
        $view->timeslots = $timeslotMapper->readAll();
        $view->days      = $timeslotMapper->readAllDays();

        $roomMapper  = new RoomMapper();
        $view->rooms = $roomMapper->readAll();

        $lecturerMapper  = new LecturerMapper();
        $view->lecturers = $lecturerMapper->readAll();
    }
}