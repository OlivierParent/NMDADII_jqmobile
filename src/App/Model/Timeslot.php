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

class Timeslot extends \Ahs\ModelAbstract
{
    /**
     * Lestijd Id
     *
     * @var int
     */
    protected $id;

    /**
     * Dag
     *
     * @var string
     */
    protected $day;

    /**
     * Starttijd
     *
     * @var string
     */
    protected $start;

    /**
     * Eindtijd
     *
     * @var string
     */
    protected $end;

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
                case 'day':
                    $this->setDay($value);
                    break;
                case 'start':
                    $this->setStart($value);
                    break;
                case 'end':
                    $this->setEnd($value);
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * Getter voor Olod Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter voor Olod Id
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter voor Dag
     *
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Setter voor Dag
     *
     * @param \App\Model\Day $day
     */
    public function setDay($day)
    {
        $this->day = new \App\Model\Day(['id' => $day]);
    }

    /**
     * Getter voor Starttijd
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Setter voor Starttijd
     *
     * @param string $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * Getter voor Starttijd
     *
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Setter voor Eindtijd
     *
     * @param string $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }
}
