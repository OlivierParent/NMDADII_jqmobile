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

class View
{
    /**
     * @var string Bestandsnaam.
     */
    protected $filename;

    public function __construct()
    {
        $filename = PATH_SOURCE         . 'App'
                  . DIRECTORY_SEPARATOR . 'View'
                  . DIRECTORY_SEPARATOR . 'Scripts'
                  . DIRECTORY_SEPARATOR . Route::getController()
                  . DIRECTORY_SEPARATOR . Route::getAction() . '.phtml';
        if (file_exists($filename)) {
            $this->filename = $filename;
        } else {
            throw new \ErrorException("Cannot find file <strong>{$filename}</strong>");
        }
    }

    public function __destruct()
    {
        require_once $this->filename;
    }

    public function path($url = '')
    {
        return PATH_WEBROOT . '/' . $url;
    }

    public function partial($partial_view)
    {
        $filename = PATH_SOURCE         . 'App'
                  . DIRECTORY_SEPARATOR . 'View'
                  . DIRECTORY_SEPARATOR . 'Partials'
                  . DIRECTORY_SEPARATOR . $partial_view . '.phtml';
        if (file_exists($filename)) {
            include $filename;
            echo PHP_EOL;
        } else {
            throw new \ErrorException("Cannot find file <strong>{$filename}</strong>");
        }
    }
}
