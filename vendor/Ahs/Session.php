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

class Session
{
    public function __construct($name = 'Ahs')
    {
        session_start();
    }

    public function create($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function destroy()
    {
        // Sessie verwijderen, zie: http://courses.olivierparent.be/php/webpaginas/sessies/
        session_destroy(); // Sessie vernietigen, maar $_SESSION blijft in geheugen tot volgende page load
        $_SESSION = null;  // $_SESSION leegmaken
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function read($key)
    {
        return $_SESSION[$key];
    }
}
