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

class StudentMapper extends \Ahs\ModelMapperAbstract
{
    /**
     * @param  \App\Model\Student $student
     * @return \App\Model\Student
     * @throws \Exception
     * @throws \ErrorException
     */
    public function create(Student $student)
    {
        // SQL-statement.
        $sql = 'INSERT INTO `student` '
             . '(`std_givenname`, `std_familyname`, `std_email`, `std_salt`, `std_password`) '
             . 'VALUES (:givenname, :familyname, :email, :salt, :password)';

        // Als het prepared statement gelukt is:
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de waarden van de variabelen aan het prepared statement.
            $stmt->bindValue(':givenname' , $student->getGivenname() ); // Waarde op dit moment binden.
            $stmt->bindValue(':familyname', $student->getFamilyname()); // Waarde op dit moment binden.
            $stmt->bindValue(':email'     , $student->getEmail()     ); // Waarde op dit moment binden.
            $stmt->bindValue(':salt'      , $student->getSalt()      ); // Waarde op dit moment binden.
            $stmt->bindValue(':password'  , $student->getPassword()  ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                // Geeft de waarde terug van de AUTO_INCREMENT kolom van de laatst ingevoegde rij.
                $student->setId($this->db->lastInsertId());

                return $student;
            }
            throw new \Exception('Could not create `Student`');
        }
        throw new \ErrorException('Unexpected error');
    }

    /**
     * @param \App\Model\Student $student
     * @throws \Exception
     */
    public function read(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT `std_id` AS `id`, `std_givenname` AS `givenname`, `std_familyname` AS `familyname`, `std_email` AS `email` '
             . 'FROM `student` '
             . 'WHERE `std_id` = :id '
             . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':id'   , $student->getId()   ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                if ($row = $stmt->fetch()) {
                    $student = new Student($row, false, false);
                } else {
                    $student = new Student([], false, false);
                }
                return $student;
            }
            throw new \Exception('Could not read `Student`');
        }
    }

    /**
     * @param \App\Model\Student $student
     * @throws \Exception
     */
    public function readAuthenticate(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT `std_id` AS `id`, `std_givenname` AS `givenname`, `std_familyname` AS `familyname`, `std_email` AS `email` '
             . 'FROM `student` '
             . 'WHERE `std_email` = :email AND `std_salt` = :salt AND `std_password` = :password '
             . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':email'   , $student->getEmail()   ); // Waarde op dit moment binden.
            $stmt->bindValue(':salt'    , $student->getSalt()    ); // Waarde op dit moment binden.
            $stmt->bindValue(':password', $student->getPassword()); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                if ($row = $stmt->fetch()) {
                    $student = new Student($row, false, false);
                } else {
                    $student = new Student([], false, false);
                }
                return $student;
            }
            throw new \Exception('Could not read `Student`');
        }
    }

    /**
     * @param \App\Model\Student $student
     * @return \App\Model\Student
     * @throws \Exception
     */
    public function hashCredentials(Student $student)
    {
        // SQL-statement.
        $sql = 'SELECT `std_salt` AS `salt` '
             . 'FROM `student` '
             . 'WHERE `std_email` = :email '
             . 'LIMIT 1';

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':email'   , $student->getEmail()   ); // Waarde op dit moment binden.

            // Voer het prepared statement uit.
            if ($stmt->execute()) {
                $row = $stmt->fetch();

                $student->setSalt($row['salt'], false);
                $student->setPassword($student->getPassword());
                return $student;
            }
            throw new \Exception('Could not has credentials for `Student`');
        }
    }
}
