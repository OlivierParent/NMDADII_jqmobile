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

namespace App\Model;

class Schedule extends \Ahs\ModelAbstract
{
    /**
     * Opleidingsonderdeel Id
     *
     * @var string
     */
    protected $id;

    /**
     * Student
     *
     * @var \App\Model\Student
     */
    protected $student;

    /**
     * Opleidingsonderdeel
     *
     * @var \App\Model\Course
     */
    protected $course;

    /**
     * Lestijd
     *
     * @var \App\Model\Timeslot
     */
    protected $timeslot;

    /**
     * Lokaal
     *
     * @var \App\Model\Room
     */
    protected $room;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'student':
                    $student = new Student(['id' => $value], false, false);
                    $studentMapper = new StudentMapper();
                    $this->setStudent($studentMapper->read($student) );
                    break;
                case 'course':
                    $course = new Course(['id' => $value]);
                    $courseMapper = new CourseMapper();
                    $this->setCourse($courseMapper->read($course) );
                    break;
                case 'timeslot':
                    $timeslot = new Timeslot(['id' => $value]);
                    $timeslotMapper = new TimeslotMapper();
                    $this->setTimeslot($timeslotMapper->read($timeslot) );
                    break;
                case 'room':
                    $room = new Room(['id' => $value]);
                    $roomMapper = new RoomMapper();
                    $this->setRoom($roomMapper->read($room) );
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * Getter voor Dag Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter voor Dag Id
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter voor Student
     *
     * @return \App\Model\Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Setter voor Student
     *
     * @param \App\Model\Student $student
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Getter voor Opleidingsonderdeel
     *
     * @return \App\Model\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Setter voor Opleidingsonderdeel
     *
     * @param \App\Model\Course $course
     */
    public function setCourse(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Getter voor Lestijd
     *
     * @return \App\Model\Timeslot
     */
    public function getTimeslot()
    {
        return $this->timeslot;
    }

    /**
     * Setter voor Lestijd
     *
     * @param \App\Model\Timeslot $timeslot
     */
    public function setTimeslot(Timeslot $timeslot)
    {
        $this->timeslot = $timeslot;
    }

    /**
     * Getter voor Lokaal
     *
     * @return \App\Model\Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Setter voor Lokaal
     *
     * @param \App\Model\Room $room
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;
    }
}