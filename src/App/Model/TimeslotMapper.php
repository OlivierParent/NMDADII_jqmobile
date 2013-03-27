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

class TimeslotMapper extends \Ahs\ModelMapperAbstract
{
    /**
     * @param \App\Model\Timeslot $timeslot
     * @throws \Exception
     */
    public function read(Timeslot $timeslot)
    {
        // SQL-statement.
        $sql = 'SELECT `tms_id` AS `id`, `tms_day` AS `day`, TIME_FORMAT(`tms_start`, \'%H:%i\') AS `start`, TIME_FORMAT(`tms_end`, \'%H:%i\') AS `end` '
             . 'FROM `timeslot` '
             . 'WHERE `tms_id` = :id '
             . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':id', $timeslot->getId() ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                $row = $stmt->fetch();

                return new Timeslot($row);
            }
            throw new \Exception('Could not read `Timeslot`');
        }
    }


    /**
     * @return array \App\Model\Timeslot
     */
    public function readAll()
    {
        // SQL-statement.
        $sql = 'SELECT `tms_id` AS `id`, `tms_day` AS `day`, TIME_FORMAT(`tms_start`, \'%H:%i\') AS `start`, TIME_FORMAT(`tms_end`, \'%H:%i\') AS `end` '
             . 'FROM `timeslot` '
             . 'ORDER BY `day` ASC, `start` ASC';

        $timeslots = [];

        $res = $this->db->query($sql);
        while ($row = $res->fetch()) {
            $timeslots[] = new Timeslot($row);
        }

        return $timeslots;
    }

    /**
     * @return array \App\Model\Day
     */
    public function readAllDays()
    {
        // SQL-statement.
        $sql = 'SELECT DISTINCT `tms_day` as `name` '
             . 'FROM `timeslot` '
             . 'ORDER BY `tms_day` ASC';

        $res = $this->db->query($sql);
        $days = [];
        if ($res_days = $res->fetchAll()) {
            foreach ($res_days as $res_day) {
                $days[] = new Day($res_day);
            }
        }
        return $days;
    }
}
