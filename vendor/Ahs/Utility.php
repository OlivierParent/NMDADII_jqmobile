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

class Utility
{
    /**
     * Bereken een hash-code voor een karakterstring op basis van de HMAC-methode.
     * Indien geen $algo opgegeven wordt, dan wordt de SHA-512 (512-bits Secure
     * Hash Algorithm 2) gebruikt om een hash-code met 128 tekens te genereren.
     *
     * @static
     * @param string $data Te hashen gegevens.
     * @param string $algo Gebruikt algoritme, bijvoorbeeld 'sha512'.
     * @param string $salt Salt die gebruikt wordt bij het encrypteren.
     * @param int    $iterations Aantal keer dat het hash-algoritme uitgevoerd wordt.
     * @param bool   $timed
     * @return string
     */
    public static function hash($data, $algo = 'sha512', $salt = '', $iterations = 5000, $timed = false)
    {
        while (0 < $iterations--) {
            if ($timed) {
                // Zie: http://www.php.net/manual/en/function.microtime.php
                $salt .= microtime();
            }
            // Zie: http://www.php.net/manual/en/function.hash-hmac.php
            $data = hash_hmac($algo, $data, $salt); // Hash-based Message Authentication Code
        }

        return $data;
    }

    /**
     * Bereken eenmalige een unieke hash-code met 64 tekens.
     *
     * @param string $data Te hashen gegevens.
     * @param string $algo Gebruikt algoritme, bijvoorbeeld 'sha256'.
     * @param string $salt
     * @param int $iterations
     * @param bool $timed
     * @return string
     */
    public static function salt($data, $algo = 'sha256', $salt = '', $iterations = 5000, $timed = true)
    {
        return self::hash($data, $algo, $salt, $iterations, $timed);
    }
}
