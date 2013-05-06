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

class ViewRest
{
    /**
     * @var int
     */
    protected $responseCode = http::STATUS_CODE_OK;

    /**
     * @var string
     */
    protected $contentType = http::CONTENT_TYPE_HTML;

    /**
     * @var mixed
     */
    protected $body = null;

    public function __destruct()
    {
        http_response_code($this->responseCode);
        header("Content-Type: {$this->contentType}, charset=utf-8");
        switch ($this->contentType) {
            case http::CONTENT_TYPE_JSON:
                echo json_encode($this->body);
                break;
            default:
                if ($this->body) {
                    echo $this->body;
                }
                break;
        }
    }

    /**
     * Zet HTTP Response Status Code.
     *
     * @param int $responseCode
     * @return \Ahs\ViewRest
     */
    public function setResponseCode($responseCode)
    {
        switch ($responseCode) {
            case Http::STATUS_CODE_OK:
            case Http::STATUS_CODE_CREATED:
            case Http::STATUS_CODE_ACCEPTED:
            case Http::STATUS_CODE_NO_CONTENT:
            case Http::STATUS_CODE_NOT_IMPLEMENTED:
                $this->responseCode = $responseCode;
                break;
            default:
                $this->responseCode = Http::STATUS_CODE_OK;
                break;
        }

        return $this; // Maakt deze methode 'chainable'
    }

    /**
     * Zet HTTP Content-Type.
     *
     * @param string $contentType
     * @return \Ahs\ViewRest
     */
    public function setContentType($contentType)
    {
        switch ($contentType) {
            case Http::CONTENT_TYPE_JSON:
                $this->contentType = $contentType;
                break;
            default:
                $this->contentType = Http::CONTENT_TYPE_HTML;
                break;
        }

        return $this; // Maakt deze methode 'chainable'
    }

    /**
     * Zet de body content.
     *
     * @param mixed $body
     * @return \Ahs\ViewRest
     */
    public function setBody($body = null)
    {
        $this->body = $body;

        return $this; // Maakt deze methode 'chainable'
    }
}