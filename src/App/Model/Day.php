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

class Day extends \Ahs\ModelAbstract
{
    /**
     * Opleidingsonderdeel Id
     *
     * @var string
     */
    protected $id;

    /**
     * Naam
     *
     * @var string
     */
    protected $name;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $this->setId($value);
                    $this->setName($value);
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * Getter voor Dag Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter voor Dag Id
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
        $days = [
            'MON' => 'maandag',
            'TUE' => 'dinsdag',
            'WED' => 'woensdag',
            'THU' => 'donderdag',
            'FRI' => 'vrijdag',
        ];

        $this->name = $days[$name];
    }
}
