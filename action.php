<?php
/**
 * @license    MIT
 * @author     Gero Gothe <practical@medizin-lernen.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();


class action_plugin_sendhtml extends DokuWiki_Action_Plugin{

    function register(Doku_Event_Handler $controller) {		
        $controller->register_hook('TPL_CONTENT_DISPLAY', 'BEFORE', $this, 'sendpage');
    }

    /**
     * Handles sendhtml action
     */
	function sendpage() {
		global $ID;
        
        if (isset($_GET['sendhtml'])) {
            $adress = $_GET['sendhtml'];
            if (!mail_isvalid($adress)) {
                msg("Ungültige E-Mail-Adresse: \"$adress\"",-1);
                return;
            }
        } else return;
		
        $mail = new Mailer();
        $mail->to($adress);
        $mail->subject(p_get_first_heading($ID));

		$html = p_wiki_xhtml($ID);
                
		$mail->setBody("",null,null,$html);
		
        $ok = $mail->send();

        // check result
        if($ok){
            msg('Seite wurde per E-Mail verschickt',1);
        }else{
            msg('E-Mail konnte nicht verschickt werden.',-1);
        }
	
	}
	 	 
}
