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

use Ahs\ModelAbstract;

class Course extends ModelAbstract
{
    /**
     * Opleidingsonderdeel Id
     *
     * @var int
     */
    protected $id;

    /**
     * Naam
     *
     * @var string
     */
    protected $name;

    /**
     * Docenten
     *
     * @var array
     */
    protected $lecturers = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $this->setId($value);
                    break;
                case 'name':
                    $this->setName($value);
                    break;
                default:
                    break;
            }
        }

        $lectureMapper = new LecturerMapper();
        $this->lecturers = $lectureMapper->readAllForCourse($this);
    }

    /**
     * Getter voor Opleidingsonderdeel Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter voor Opleidingsonderdeel Id
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter voor Naam
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter voor Naam
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * Getter voor Docenten
     *
     * @return array
     */
    public function getLecturers()
    {
        return $this->lecturers;
    }

    /**
     * @param Lecturer $lecturer
     */
    public function addLecturer(Lecturer $lecturer)
    {
        $this->lecturers[] = $lecturer;
    }

    public function toArray()
    {
        return [
          'id'   => $this->getId(),
          'name' => $this->getName(),
        ];
    }
}
