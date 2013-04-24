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
     * Bestandsnaam van het View Script.
     *
     * @var string
     */
    protected $filename;

    /**
     * Scripts in de head van de pagina.
     *
     * @var array
     */
    protected $headScripts = [];

    /**
     * Stylesheet links in de head van de pagina.
     *
     * @var array
     */
    protected $headStylesheets = [];

    /**
     * Stel de naam van het View Script samen dat overeenkomt met de Controller
     * en Controller Action-methode.
     *
     * @throws \ErrorException
     */
    public function __construct()
    {
        $filename = PATH_SOURCE         . ApplicationAbstract::DIRECTORY_APP
                  . DIRECTORY_SEPARATOR . ApplicationAbstract::DIRECTORY_VIEW
                  . DIRECTORY_SEPARATOR . ApplicationAbstract::DIRECTORY_VIEW_SCRIPTS
                  . DIRECTORY_SEPARATOR . Route::getController()
                  . DIRECTORY_SEPARATOR . Route::getAction() . ApplicationAbstract::FILE_EXTENSION_VIEW;
        if (file_exists($filename)) {
            $this->filename = $filename;
        } else {
            throw new \ErrorException("Cannot find file <strong>{$filename}</strong>");
        }
    }

    /**
     * Render het View Script.
     */
    public function __destruct()
    {
        require_once $this->filename;
    }

    /**
     * Voeg een script toe aan de head van de HTML-pagina.
     *
     * @param string $script
     * @return \Ahs\View
     */
    public function addHeadScript($script)
    {
        $this->headScripts[] = "    <script src=\"{$script}\"></script>" . PHP_EOL;

        return $this; // Maakt deze methode 'chainable'
    }

    /**
     * Voeg een stylesheet link toe aan de head van de HTML-pagina.
     *
     * @param string $stylesheet
     * @return \Ahs\View
     */
    public function addHeadStylesheet($stylesheet)
    {
        $this->headStylesheets[] = "    <link rel=\"stylesheet\" href=\"{$stylesheet}\">" . PHP_EOL;

        return $this; // Maakt deze methode 'chainable'
    }

    /**
     * Voegt het pad van de webroot toe aan een relatief pad.
     *
     * @param string $url
     * @return string
     */
    public function path($url = '')
    {
        return PATH_WEBROOT . '/' . $url;
    }

    /**
     * Render een Partial View Script.
     *
     * @param string $partial_view
     * @throws \ErrorException
     */
    public function partial($partial_view)
    {
        $filename = PATH_SOURCE         . ApplicationAbstract::DIRECTORY_APP
                  . DIRECTORY_SEPARATOR . ApplicationAbstract::DIRECTORY_VIEW
                  . DIRECTORY_SEPARATOR . ApplicationAbstract::DIRECTORY_VIEW_PARTIALS
                  . DIRECTORY_SEPARATOR . $partial_view . ApplicationAbstract::FILE_EXTENSION_VIEW;
        if (file_exists($filename)) {
            include $filename;
            echo PHP_EOL;
        } else {
            throw new \ErrorException("Cannot find file <strong>{$filename}</strong>");
        }
    }
}
