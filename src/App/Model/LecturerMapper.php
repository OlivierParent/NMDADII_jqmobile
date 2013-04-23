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

class LecturerMapper extends \Ahs\ModelMapperAbstract
{
    /**
     * @param  \App\Model\Lecturer $lecturer
     * @return \App\Model\Lecturer
     * @throws \Exception
     * @throws \ErrorException
     */
    public function create(Lecturer $lecturer)
    {
        // SQL-statement.
        $sql = 'INSERT INTO `lecturer` '
             . '       (`std_givenname`, `std_familyname`, `std_email`) '
             . 'VALUES (    :givenname ,     :familyname ,     :email )';

        // Als het prepared statement gelukt is:
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':givenname' , $lecturer->getGivenname()  ); // Waarde op dit moment binden.
            $stmt->bindValue(':familyname', $lecturer->getFamilyname() ); // Waarde op dit moment binden.
            $stmt->bindValue(':email'     , $lecturer->getEmail()      ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute() ) {
                // Geeft de waarde terug van de AUTO_INCREMENT kolom van de laatst ingevoegde rij.
                $lecturer->setId($this->db->lastInsertId());

                return $lecturer;
            }
            throw new \Exception('Could not create `lecturer`');
        }
        throw new \ErrorException('Unexpected error');
    }

    /**
     * @param  \App\Model\Lecturer $lecturer
     * @throws \Exception
     */
    public function read(Lecturer $lecturer)
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`lec_id`         AS `id`, '
             . '`lec_givenname`  AS `givenname`, '
             . '`lec_familyname` AS `familyname`, '
             . '`lec_email`      AS `email` '
             . 'FROM `lecturer` '
             . 'WHERE `lec_id` = :id '
             . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':id', $lecturer->getId() ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute() ) {
                $row = $stmt->fetch();

                return new Lecturer($row);
            }
            throw new \Exception('Could not read `lecturer`');
        }
    }

    /**
     * @return array \App\Model\Lecturer
     */
    public function readAll()
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`lec_id`         AS `id`, '
             . '`lec_givenname`  AS `givenname`, '
             . '`lec_familyname` AS `familyname`, '
             . '`lec_email`      AS `email` '
             . 'FROM `lecturer` '
             . 'ORDER BY `familyname` ASC, `givenname` ASC';

        $lecturers = [];

        $res = $this->db->query($sql);
        while ($row = $res->fetch()) {
            $lecturers[] = new Lecturer($row);
        }

        return $lecturers;
    }

    /**
     * @param  \App\Model\Course $course
     * @return array \App\Model\Lecturer
     */
    public function readAllForCourse(Course $course)
    {
        // SQL-statement.
        $sql = 'SELECT '
             . '`lec_id`         AS `id`, '
             . '`lec_givenname`  AS `givenname`, '
             . '`lec_familyname` AS `familyname`, '
             . '`lec_email`      AS `email` '
             . 'FROM `lecturer` NATURAL JOIN `course_has_lecturer` '
             . 'WHERE `crs_id` = :course '
             . 'ORDER BY `familyname` ASC, `givenname` ASC';


        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':course', $course->getId() ); // Waarde op dit moment binden.

            $lecturers = [];
            if ($stmt->execute() ) {
                while ($row = $stmt->fetch()) {
                    $lecturers[] = new Lecturer($row);
                }
            }

            return $lecturers;
        }
    }
}
