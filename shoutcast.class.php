<?php
/**
 * A simple Class to get all needed Info's from an Shoutcast-Server
 * 
 * @author Starflow <starflow@list.ru>
 * @version 1.0.0
 */
class shoutcast {
    /**
     * @var string IP of the SC-Server
     * @access private
     */
    private $ip;
    /**
     * @var int Port the SC-Server listens on
     * @access private
     */
    private $port;
    /**
     * @var string Password for the admin.cgi
     * @access private
     */
    private $pass;
    /**
     * @var string Complete URL to the XML-Data generated by the SC-Server
     * @access private
     */
    private $xmlURL;
    /**
     * @var string User for the admin.cgi
     * @access private
     */
    private $user = 'admin';

    /**
     * Constructor
     * Creates an Shoutcast Object and initalises the Member Vars
     * 
     * @param string $ip IP of the SC-Server
     * @param string $port Port the SC-Server listens on
     * @param string $pass Password for the admin.cgi
     */
    public function __construct( $ip, $port, $pass ) {
        $this->ip   = $ip;
        $this->port = $port;
        $this->pass = $pass;
        $this->xmlURL = 'http://' . $this->ip . ':' . $this->port . '/admin.cgi?mode=viewxml';
        
    }
    
    /**
     * Returns the Stats from the Shoutcast XML as Array
     * (Songhistory not included, use getShoutcastHistory() to get the Songhistory)
     * 
     * @return array
     */
    public function getShoutcastData() {
        $xml = simplexml_load_string( $this->getXML() );
        $array = get_object_vars( $xml );
        unset( $array['SONGHISTORY'] );
        
        foreach( $array as $key => $value ) {
            if( is_object( $array[$key] ) && !empty( $array[$key] ) ) {
                $array[$key] = get_object_vars( $array[$key] );
            } elseif( empty( $array[$key] ) && $array[$key] !== '0' ) {
                unset( $array[$key] );
            }
        }
        
        return $array;
    }
    
    /**
     * Returns the Songhistory from the given Shoutcastserver as Array
     * 
     * @return array
     */
    public function getShoutcastHistory() {
        $xml = simplexml_load_string( $this->getXML() );
        $history = $xml->SONGHISTORY;
        $history = get_object_vars( $history );
        
        foreach( $history['SONG'] as $key => $value ) {
            if( is_object( $history['SONG'][$key] ) && !empty( $history['SONG'][$key] ) ) {
                $history['SONG'][$key] = get_object_vars( $history['SONG'][$key] );
            } elseif( empty( $history['SONG'][$key] ) && $history['SONG'][$key] !== '0' ) {
                unset( $history['SONG'][$key] );
            }
        }
        
        return $history['SONG'];
    }
    
    /**
     * Gets the XML-Data generated by the Shoutcast Server
     * 
     * @return string
     * @access private
     */
    private function getXML() {
        $header = array(
            'http' => array(
                'header' => 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:5.0) Gecko/20100101 Firefox/5.0' . "\r\n" . 
                            'Authorization: Basic ' . base64_encode( $this->user . ':' . $this->pass ) . "\r\n",
            ),
        );
        $context = stream_context_create( $header );
        $xml = file_get_contents( $this->xmlURL, false, $context );
        
        return $xml;
    }
}

?>
