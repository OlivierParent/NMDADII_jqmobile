<?php

/* * ****************************************************************************
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
 * *****************************************************************************
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2013 Artevelde University College Ghent
 */

namespace App\Model;

use Ahs\Error;
use Ahs\ModelMapperAbstract;

class StudentMapper extends ModelMapperAbstract
{
    /**
     * @param Student $student
     * @return Student
     * @throws \ErrorException
     * @throws \Exception
     */
    public function create(Student $student)
    {
        // SQL-statement.
        $sql = 'INSERT INTO `student` '
                . '       (`std_givenname`, `std_familyname`, `std_email`, `std_salt`, `std_password`) '
                . 'VALUES (    :givenname ,     :familyname ,     :email ,     :salt ,     :password )';

        // Als het prepared statement gelukt is:
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':givenname' , $student->getGivenname());  // Waarde op dit moment binden.
            $stmt->bindValue(':familyname', $student->getFamilyname()); // Waarde op dit moment binden.
            $stmt->bindValue(':email'     , $student->getEmail());      // Waarde op dit moment binden.
            $stmt->bindValue(':salt'      , $student->getSalt());       // Waarde op dit moment binden.
            $stmt->bindValue(':password'  , $student->getPassword());   // Waarde op dit moment binden.
            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                // Geeft de waarde terug van de AUTO_INCREMENT kolom van de laatst ingevoegde rij.
                $student->setId($this->db->lastInsertId());
                return $student;
            }
            throw new \Exception(sprintf(Error::MESSAGE_CREATE, get_class($student) ) );
        }
        throw new \ErrorException(Error::MESSAGE_UNEXPECTED);
    }

    /**
     * @param Student $student
     * @return Student
     * @throws \Exception
     */
    public function read(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT '
                . '`std_id`         AS `id`, '
                . '`std_givenname`  AS `givenname`, '
                . '`std_familyname` AS `familyname`, '
                . '`std_email`      AS `email` '
                . 'FROM `student` '
                . 'WHERE `std_id` = :id '
                . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':id', $student->getId()); // Waarde op dit moment binden.
            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                if ($row = $stmt->fetch()) {
                    return new Student($row);
                }
                return new Student();
            }
            throw new \Exception(sprintf(Error::MESSAGE_READ, get_class($student) ) );
        }
        throw new \Exception(Error::MESSAGE_UNEXPECTED);
    }

    /**
     * @param Student $student
     * @return Student
     * @throws \Exception
     */
    public function readAuthenticate(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT '
                . '`std_id`         AS `id`, '
                . '`std_givenname`  AS `givenname`, '
                . '`std_familyname` AS `familyname`, '
                . '`std_email`      AS `email` '
                . 'FROM `student` '
                . 'WHERE `std_email` = :email AND '
                . '`std_password` = :password '
                . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':email'   , $student->getEmail());    // Waarde op dit moment binden.
            $stmt->bindValue(':password', $student->getPassword()); // Waarde op dit moment binden.
            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                if ($row = $stmt->fetch()) {
                    return new Student($row);
                }
                return new Student();
            }
            throw new \Exception(sprintf(Error::MESSAGE_READ_AUTHENTICATE, get_class($student) ) );
        }
        throw new \Exception(Error::MESSAGE_UNEXPECTED);
    }

    /**
     * @param Student $student
     * @return Student
     * @throws \Exception
     */
    public function setCredentials(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT `std_salt` AS `salt` '
             . 'FROM `student` '
             . 'WHERE `std_email` = :email '
             . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':email', $student->getEmail()); // Waarde op dit moment binden.
            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                if ($row = $stmt->fetch() ) {
                    $student->setSalt($row['salt']);
                    return $student;
                }
                throw new \Exception(sprintf(Error::MESSAGE_READ_VERIFY, get_class($student) ) );
            }
            throw new \Exception(sprintf(Error::MESSAGE_READ_CREDENTIALS, get_class($student) ) );
        }
        throw new \Exception(Error::MESSAGE_UNEXPECTED);
    }
}
