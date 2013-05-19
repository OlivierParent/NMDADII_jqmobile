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

class Error
{
    const MESSAGE_CREATE            = 'Kan %s niet aanmaken in tabel';

    const MESSAGE_READ              = 'Kan %s niet ophalen uit tabel';
    const MESSAGE_READ_AUTHENTICATE = 'Kan %s niet authenticeren';
    const MESSAGE_READ_CREDENTIALS  = 'Kan de credentials voor %s ophalen uit tabel';
    const MESSAGE_READ_VERIFY       = 'Kan de credentials voor %s niet verifiëren';

    const MESSAGE_UPDATE            = 'Kan %s niet updaten in tabel';

    const MESSAGE_DELETE            = 'Kan %s niet verwijderen uit tabel';

    const MESSAGE_UNEXPECTED        = 'Onverwachte fout';
}
