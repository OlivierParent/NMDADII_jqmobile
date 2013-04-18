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

class CourseMapper extends \Ahs\ModelMapperAbstract
{
    /**
     * @param \App\Model\Course $course
     * @param \App\Model\Lecturer $lecturer
     * @return string
     * @throws \Exception
     * @throws \ErrorException
     */
    public function createHasLecturer(Course $course, Lecturer $lecturer)
    {
        // SQL-statement.
        $sql = 'INSERT IGNORE INTO `course_has_lecturer` '
             . '(`crs_id`, `lec_id`) '
             . 'VALUES (:course, :lecturer)';

        // Als het prepared statement gelukt is:
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':course'  , $course  ->getId() ); // Waarde op dit moment binden.
            $stmt->bindValue(':lecturer', $lecturer->getId() ); // Waarde op dit moment binden.

            if ($stmt->execute()) {
                // Geeft de waarde terug van de AUTO_INCREMENT kolom van de laatst ingevoegde rij.

                return $this->db->lastInsertId();
            }
            throw new \Exception('Could not create `Course_has_Lecturer`');
        }
        throw new \ErrorException('Unexpected error');
    }

    /**
     * @param \App\Model\Course $course
     * @throws \Exception
     */
    public function read(Course $course)
    {
        // SQL-statement.
        $sql = 'SELECT `crs_id` AS `id`, `crs_name` AS `name` '
             . 'FROM `course` '
             . 'WHERE `crs_id` = :id '
             . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':id', $course->getId() ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                $row = $stmt->fetch();

                return new Course($row);
            }
            throw new \Exception('Could not read `Course`');
        }
    }

    /**
     * @return array \App\Model\Course
     */
    public function readAll()
    {
        // SQL-statement.
        $sql = 'SELECT `crs_id` AS `id`, `crs_name` AS `name` '
             . 'FROM `course` '
             . 'ORDER BY name ASC';

        $courses = [];

        $res = $this->db->query($sql);
        while ($row = $res->fetch()) {
            $courses[] = new Course($row);
        }

        return $courses;
    }
}
