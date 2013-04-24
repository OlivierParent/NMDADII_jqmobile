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

class Lecturer extends ModelAbstract
{
    /**
     * Docent Id
     *
     * @var int
     */
    protected $id;

    /**
     * Voornaam
     *
     * @var string
     */
    protected $givenname;

    /**
     * Familiennaam
     *
     * @var string
     */
    protected $familyname;

    /**
     * E-mailadres
     *
     * @var string
     */
    protected $email;

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
                case 'givenname':
                    $this->setGivenname($value);
                    break;
                case 'familyname':
                    $this->setFamilyname($value);
                    break;
                case 'email':
                    $this->setEmail($value);
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * Getter voor Docent Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter voor Docent Id
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter voor Voornaam
     *
     * @return string
     */
    public function getGivenname()
    {
        return $this->givenname;
    }

    /**
     * Setter voor Voornaam
     *
     * @param string $givenname
     */
    public function setGivenname($givenname)
    {
        $this->givenname = $givenname;
    }

    /**
     * Getter voor Familienaam
     *
     * @return string
     */
    public function getFamilyname()
    {
        return $this->familyname;
    }

    /**
     * Setter voor Familienaam
     *
     * @param string $familyname
     */
    public function setFamilyname($familyname)
    {
        $this->familyname = $familyname;
    }

    /**
     * Getter voor E-mailadres
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Setter voor E-mailadres
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
