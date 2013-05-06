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

use Ahs\Error;
use Ahs\ModelMapperAbstract;

class ScheduleMapper extends ModelMapperAbstract
{
    /**
     * @param Schedule $schedule
     * @return Schedule
     * @throws \ErrorException
     * @throws \Exception
     */
    public function create(Schedule $schedule)
    {
        // SQL-statement.
        $sql = 'INSERT IGNORE INTO `schedule` '
             . '       (`std_id`, `tms_id` , `crs_id`, `rom_id`) '
             . 'VALUES (:student, :timeslot, :course , :room   )';

        // Als het prepared statement gelukt is:
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':student' , $schedule->getStudent() ->getId() ); // Waarde op dit moment binden.
            $stmt->bindValue(':timeslot', $schedule->getTimeslot()->getId() ); // Waarde op dit moment binden.
            $stmt->bindValue(':course'  , $schedule->getCourse()  ->getId() ); // Waarde op dit moment binden.
            $stmt->bindValue(':room'    , $schedule->getRoom()    ->getId() ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                // Geeft de waarde terug van de AUTO_INCREMENT kolom van de laatst ingevoegde rij.
                $schedule->setId($this->db->lastInsertId());
                return $schedule;
            }
            throw new \Exception(sprintf(Error::MESSAGE_CREATE, get_class($schedule) ) );
        }
        throw new \ErrorException(Error::MESSAGE_UNEXPECTED);
    }

    /**
     * @return array Schedule
     */
    public function readAll()
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`std_id` AS `student`, '
             . '`tms_id` AS `timeslot`, '
             . '`crs_id` AS `course`, '
             . '`rom_id` AS `room` '
             . 'FROM `schedule`';

        $schedules = [];

        $stmt = $this->db->query($sql);
        if ($stmt) {
            while ($row = $stmt->fetch()) {
                $schedules[] = new Schedule($row);
            }
        }

        return $schedules;
    }

    /**
     * @param Student $student
     * @return array Schedule
     */
    public function readAllForStudentToday(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`std_id` AS `student`, '
             . '`tms_id` AS `timeslot`, '
             . '`crs_id` AS `course`, '
             . '`rom_id` AS `room` '
             . 'FROM `schedule` NATURAL JOIN `timeslot` '
             . 'WHERE `tms_day` = :today AND '
             . '      `std_id`  = :student '
             . 'ORDER BY `tms_start` ASC';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {

            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':today'  , Day::$week[date('N')] ); // Waarde op dit moment binden.
            $stmt->bindValue(':student', $student->getId() ); // Waarde op dit moment binden.

            $schedules = [];

            if ($stmt->execute() ) {
                while ($row = $stmt->fetch() ) {
                    $schedules[] = new Schedule($row);
                }
            }

            return $schedules;
        }
    }

    /**
     * @param Student $student
     * @return array Schedule
     */
    public function readAllForStudent(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`std_id` AS `student`, '
             . '`tms_id` AS `timeslot`, '
             . '`crs_id` AS `course`, '
             . '`rom_id` AS `room` '
             . 'FROM `schedule` NATURAL JOIN `timeslot` '
             . 'WHERE `std_id` = :student '
             . 'ORDER BY `tms_day` ASC, `tms_start` ASC';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':student', $student->getId() ); // Waarde op dit moment binden.

            $schedules = [];
            if ($stmt->execute() ) {
                while ($row = $stmt->fetch() ) {
                    $schedules[] = new Schedule($row);
                }
            }

            return $schedules;
        }
    }

    /**
     * @param Schedule $schedule
     */
    public function delete(Schedule $schedule)
    {
        // SQL-statement.
        $sql = 'DELETE '
             . 'FROM `schedule` '
             . 'WHERE `std_id` = :student AND '
             . '      `tms_id` = :timeslot';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':student' , $schedule->getStudent() ->getId() ); // Waarde op dit moment binden.
            $stmt->bindValue(':timeslot', $schedule->getTimeslot()->getId() ); // Waarde op dit moment binden.
            $stmt->execute();
        }
    }
}
