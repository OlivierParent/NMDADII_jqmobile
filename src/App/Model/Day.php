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

class Day extends ModelAbstract
{
    const MON = 'MON';
    const TUE = 'TUE';
    const WED = 'WED';
    const THU = 'THU';
    const FRI = 'FRI';

    public static $week = [
        1 => self::MON,
        2 => self::TUE,
        3 => self::WED,
        4 => self::THU,
        5 => self::FRI,
        6 => self::MON, // Dagen in het weekend worden automatisch 'maandag'.
        7 => self::MON,
    ];

    public static $days = [
        self::MON => 'maandag',
        self::TUE => 'dinsdag',
        self::WED => 'woensdag',
        self::THU => 'donderdag',
        self::FRI => 'vrijdag',
    ];

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
        $this->name = self::$days[$name];
    }
}
