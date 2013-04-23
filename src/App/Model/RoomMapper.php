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

class RoomMapper extends \Ahs\ModelMapperAbstract
{
    /**
     * @param  \App\Model\Room $room
     * @throws \Exception
     */
    public function read(Room $room)
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`rom_id`   AS `id`, '
             . '`rom_name` AS `name` '
             . 'FROM `room` NATURAL JOIN `campus` '
             . 'WHERE `rom_id` = :id '
             . 'ORDER BY `cam_name` ASC, `rom_name` ASC '
             . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':id', $room->getId() ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute() ) {
                $row = $stmt->fetch();

                return new Room($row);
            }
            throw new \Exception('Could not read `room`');
        }
    }

    /**
     * @return array \App\Model\Room
     */
    public function readAll()
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`rom_id`   AS `id`, '
             . '`rom_name` AS `name` '
             . 'FROM `room` NATURAL JOIN `campus` '
             . 'ORDER BY `cam_name` ASC, `rom_name` ASC';

        $rooms = [];

        $res = $this->db->query($sql);
        while ($row = $res->fetch() ) {
            $rooms[] = new Room($row);
        }

        return $rooms;
    }
}
