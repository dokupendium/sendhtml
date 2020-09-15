<?php

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

/**
 * medcalc
 *
 * @license  MIT
 * @author   Gero Gothe
 */
class syntax_plugin_sendhtml extends DokuWiki_Syntax_Plugin {

    
    public function getType() {
        return 'substition';
    }

    /**
     * Paragraph Type
     */
    public function getPType() {
        return 'block';
    }

    function getSort() { return 136; }

    /**
     * @param string $mode
     */
    public function connectTo($mode) {
        $this->Lexer->addSpecialPattern('\{\{MAIL:[^\}]*\}\}', $mode, 'plugin_sendhtml');
    }

    /**
    
    */
    public function handle($match, $state, $pos, Doku_Handler $handler) {
        
        $param = substr($match,7,-2);
        
        $mail = array_map('trim',explode(',',$param));
        #$t = trim(substr($match,7,-2));
 
        return $mail;
    }
    

    /**
     * Create the new-page form.
     *
     * @param   $mode     string        output format being rendered
     * @param   $renderer Doku_Renderer the current renderer object
     * @param   $data     array         data created by handler()
     * @return  boolean                 rendered correctly?
     */
    public function render($mode, Doku_Renderer $renderer, $data) {
        global $ID;
        
        if($mode == 'xhtml') {
            
            $link = DOKU_URL . "doku.php?id=$ID&sendhtml=" . $data[0];
            $label = $data[0];
            if (isset($data[1])) $label = $data[1];
            
            $renderer->doc .= "<a href='$link' class='plugin__sendhtml_link'>Mail an: $label</a>";
            
            
            return true;
        }

        return false;
    }
}