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

class ScheduleMapper extends \Ahs\ModelMapperAbstract
{
    /**
     * @param  \App\Model\Schedule $schedule
     * @return \App\Model\Schedule
     * @throws \Exception
     * @throws \ErrorException
     */
    public function create(Schedule $schedule)
    {
        // SQL-statement.
        $sql = 'INSERT IGNORE INTO `schedule` '
             . '(`std_id`, `crs_id`, `tms_id`, `rom_id`) '
             . 'VALUES (:student, :course, :timeslot, :room)';

        // Als het prepared statement gelukt is:
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':student' , $schedule->getStudent() ->getId() ); // Waarde op dit moment binden.
            $stmt->bindValue(':course'  , $schedule->getCourse()  ->getId() ); // Waarde op dit moment binden.
            $stmt->bindValue(':timeslot', $schedule->getTimeslot()->getId() ); // Waarde op dit moment binden.
            $stmt->bindValue(':room'    , $schedule->getRoom()    ->getId() ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                // Geeft de waarde terug van de AUTO_INCREMENT kolom van de laatst ingevoegde rij.
                $schedule->setId($this->db->lastInsertId());

                return $schedule;
            }
            throw new \Exception('Could not create `Schedule`');
        }
        throw new \ErrorException('Unexpected error');
    }

    public function readAll()
    {
        // SQL-statement.
        $sql = 'SELECT `std_id` AS `student`, `crs_id` AS `course`, `tms_id` AS `timeslot`, `rom_id` AS `room` '
             . 'FROM `schedule`';

        $schedules = [];

        $res = $this->db->query($sql);
        while ($row = $res->fetch()) {
            $schedules[] = new Schedule($row);
        }

        return $schedules;
    }

    public function readAllForStudentToday(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT `std_id` AS `student`, `crs_id` AS `course`, `tms_id` AS `timeslot`, `rom_id` AS `room` '
             . 'FROM `schedule` NATURAL JOIN `timeslot` '
             . 'WHERE `tms_day` = :today AND `std_id` = :student '
             . 'ORDER BY `tms_start` ASC';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $today = [
                1 => 'MON',
                2 => 'TUE',
                3 => 'WED',
                4 => 'THU',
                5 => 'FRI',
                6 => 'MON',
                7 => 'MON',
            ];

            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':today'  , $today[date('N')] ); // Waarde op dit moment binden.
            $stmt->bindValue(':student', $student->getId() ); // Waarde op dit moment binden.

            $schedules = [];
            if ($stmt->execute()) {
                while ($row = $stmt->fetch()) {
                    $schedules[] = new Schedule($row);
                }
            }

            return $schedules;
        }
    }

    public function readAllForStudent(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT `std_id` AS `student`, `crs_id` AS `course`, `tms_id` AS `timeslot`, `rom_id` AS `room` '
             . 'FROM `schedule` NATURAL JOIN `timeslot` '
             . 'WHERE `std_id` = :student '
             . 'ORDER BY tms_day ASC, `tms_start` ASC';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':student', $student->getId() ); // Waarde op dit moment binden.

            $schedules = [];
            if ($stmt->execute()) {
                while ($row = $stmt->fetch()) {
                    $schedules[] = new Schedule($row);
                }
            }

            return $schedules;
        }
    }
}