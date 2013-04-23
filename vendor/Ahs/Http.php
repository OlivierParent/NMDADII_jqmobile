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

class Http
{

    /**
     * Internet Media Type
     */

    /**
     * JavaScript Object Notation
     */
    const CONTENT_TYPE_JSON = 'application/json';

    /**
     * HyperText Markup Language
     */
    const CONTENT_TYPE_HTML = 'text/html';

    /**
     * HTTP/1.1 Request Methods.
     *
     * http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html
     */

    /**
     * Verwijder resource.
     *
     * Responses: 200 met entity, 204 zonder entity, 202 nog niet verwerkt
     */
    const REQUEST_METHOD_DELETE = 'DELETE';

    /**
     * Haal informatie op
     *
     * Responses: 200 met entity of 204 zonder entity
     */
    const REQUEST_METHOD_GET    = 'GET';

    /**
     * Is een GET zonder body, enkel de headerinformatie.
     */
    const REQUEST_METHOD_HEAD   = 'HEAD';

    /**
     * Entity doorsturen naar de server. .
     *
     * Responses: 200, 204, of 201 indien er een nieuwe resource werd aangemaakt
     * op basis van de doorgestuurde entity.
     */
    const REQUEST_METHOD_POST   = 'POST';

    /**
     * Maak nieuwe of wijzig bestaande resource op basis van de meegestuurde
     * entity.
     *
     * Responses: 200, 204, of 501 indien de content header niet begrepen wordt.
     *
     */
    const REQUEST_METHOD_PUT    = 'PUT';

    /**
     * HTTP/1.1 Status Codes.
     *
     * http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
     */

    /**
     * Oké.
     */
    const STATUS_CODE_OK              = 200;

    /**
     * Nieuwe resource aangemaakt.
     */
    const STATUS_CODE_CREATED         = 201;

    /**
     * Geaccepteerd, maar nog niet verwerkt.
     */
    const STATUS_CODE_ACCEPTED        = 202;

    /**
     * Geen inhoud.
     */
    const STATUS_CODE_NO_CONTENT      = 204;

    /**
     * Niet geïmplementeerd.
     */
    const STATUS_CODE_NOT_IMPLEMENTED = 501;

}
