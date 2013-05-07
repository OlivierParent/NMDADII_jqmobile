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

namespace Ahs;

class Security
{

    const ALGO_SHA512   = '6';  // Veilig genoeg (86 tekens)
    const ALGO_BLOWFISH = '2y'; // Veiliger (PHP 5.3.7+, 32 tekens)
    const BASE64 = '0123456789./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    /**
     * Bereken een hash-code voor een karakterstring met crypt().
     *
     * @param string $str  Te hashen karakterstring.
     * @param string $salt Te gebruiken salt om een unieke hash-code te berekenen.
     * @param string $algo Te gebruiken algoritme.
     * @param int    $cost Aantal keer dat het hash-algoritme uitgevoerd wordt.
     * @return string
     */
    public static function hash($str = '', $salt = '', $algo = self::ALGO_BLOWFISH, $cost = 5000)
    {
        switch ($algo) {
            case self::ALGO_SHA512:
                if (!(is_int($cost) && 1000 <= $cost && $cost <= 999999)) {
                    $cost = 5000;
                }
                $salt = '$' . $algo . '$rounds=' . $cost . '$' . $salt;
                $length = 86;
                break;
            case self::ALGO_BLOWFISH:
            default:
                if (!(is_int($cost) && 4 <= $cost && $cost <= 31)) {
                    $cost = 7;
                }
                $salt = '$' . self::ALGO_BLOWFISH . '$' . sprintf('%02d', $cost) . '$' . $salt;
                $length = 32;
                break;
        }

        $hash = crypt($str, $salt);
        return substr($hash, -$length);
    }

    /**
     * Genereer een random salt voor een bepaald algoritme.
     *
     * @param string $algo Te gebruiken algoritme.
     * @return string
     */
    public static function generateSalt($algo = self::ALGO_BLOWFISH)
    {
        switch ($algo) {
            case self::ALGO_SHA512:
                $length = 16; // Salt is maximaal 16 tekens.
                break;
            case self::ALGO_BLOWFISH:
            default:
                $length = 22; // Salt is maximaal 22 tekens.
                break;
        }

        $max = strlen(self::BASE64) - 1;

        $salt = '';
        while (0 < $length--) {
            $salt .= substr(self::BASE64, mt_rand(0, $max), 1);
        }
        return $salt;
    }

    /**
     * Bereken een unieke hash-code.
     *
     * @param string $data Te hashen gegevens.
     * @param string $salt Te gebruiken salt.
     * @param string $algo Te gebruiken algoritme.
     * @param int $cost
     * @return string
     */
    public static function password($data = '', $salt = '', $algo = self::ALGO_BLOWFISH, $cost = 5000)
    {
        return self::hash($data, $algo, $salt, $cost);
    }

}
