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

class TimeslotMapper extends ModelMapperAbstract
{
    /**
     * @param Timeslot $timeslot
     * @return Timeslot
     * @throws \Exception
     */
    public function read(Timeslot $timeslot)
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`tms_id`                            AS `id`, '
             . '`tms_day`                           AS `day`, '
             . 'TIME_FORMAT(`tms_start`, \'%H:%i\') AS `start`, '
             . 'TIME_FORMAT(`tms_end`  , \'%H:%i\') AS `end` '
             . 'FROM `timeslot` '
             . 'WHERE `tms_id` = :id '
             . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':id', $timeslot->getId() ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute() ) {
                $row = $stmt->fetch();

                return new Timeslot($row);
            }
            throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($timeslot) ) );
        }
        throw new \Exception(Error::MESSAGE_UNEXPECTED);
    }

    /**
     * @return array Timeslot
     */
    public function readAll()
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`tms_id`                            AS `id`, '
             . '`tms_day`                           AS `day`, '
             . 'TIME_FORMAT(`tms_start`, \'%H:%i\') AS `start`, '
             . 'TIME_FORMAT(`tms_end`  , \'%H:%i\') AS `end` '
             . 'FROM `timeslot` '
             . 'ORDER BY `day` ASC, `start` ASC';

        $timeslots = [];

        $stmt = $this->db->query($sql);
        while ($row = $stmt->fetch() ) {
            $timeslots[] = new Timeslot($row);
        }

        return $timeslots;
    }

    /**
     * @return array Day
     */
    public function readAllDays()
    {
        // SQL-statement.
        $sql = 'SELECT DISTINCT `tms_day` AS `name` '
             . 'FROM `timeslot` '
             . 'ORDER BY `name` ASC';

        $days = [];

        $stmt = $this->db->query($sql);
        while($row = $stmt->fetch() ) {
            $days[] = new Day($row);
        }

        return $days;
    }
}
