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

class Student extends \Ahs\ModelAbstract
{
    /**
     * Student Id
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
     * Wachtwoord Salt
     *
     * @var string
     */
    protected $salt;

    /**
     * Wachtwoord
     *
     * @var string
     */
    protected $password;


    /**
     * @param array $data
     */
    public function __construct(array $data = [], $hash_salt = true, $hash_password = true)
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

        $salt = $this->getEmail();
        if (isset($data['salt'])) {
            $this->setSalt($salt, $hash_salt);
        } else {
            if ($hash_salt) {
                $this->setSalt($salt);
            }
        }

        if (isset($data['password'])) {
            $this->setPassword($data['password'], $hash_password);
        }
    }

    /**
     * Getter voor User Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter voor User Id
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

    /**
     * Getter voor Wachtwoord
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Setter voor Wachtwoord
     *
     * @param string $password
     * @param bool $hash Vervang het wachtwoord door de hash-code van het wachtwoord.
     */
    public function setPassword($password, $hash = true)
    {
        $this->password = $hash ? \Ahs\Utility::hash($password, 'sha512', $this->getSalt()) : $password;
    }

    /**
     * Getter voor Wachtwoord Salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Setter voor Wachtwoord Salt
     *
     * @param string $salt Salt voor het wachtwoord.
     * @param bool $salt Vervang de salt door de hash-code van de salt.
     */
    public function setSalt($salt, $hash = true)
    {
        $this->salt = $hash ? \Ahs\Utility::salt($salt) : $salt;
    }
}
