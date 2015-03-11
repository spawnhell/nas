<?php

namespace GoogleMaps\Service;

/**
 * GoogleMaps\Service\GoogleMaps
 *
 * Zend Framework2 Google Map Class  (Google Maps API v3)
 *
 * An open source application development framework for PHP 5.1.6 or newer
 * 
 * This class enables the creation of google maps
 *
 * @package		Zend Framework 2
 * @author		Adam Bugajewski 
 */
 
class GoogleMaps {

    private $api_key = '';
    private $sensor = 'false';
    private $div_id = 'map-canvas';
    private $zoom = 10;
    private $lat = -300;
    private $lon = 300;
    
    
    /**
     *
     * @var bool 
     */
    private $drawingManager = false;
    
    /**
     *
     * @var bool
     */
    private $polylinesCompleteListener = false;

    private $map = null;
    private $url = 'https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=drawing';
    
    /**
     * Constructor
     * 
     * Konstruktor z ustawieniem klucza API ( potrzebny do API V2, V3 nie wymaga )
     * 
     * 
     */
    public function __construct($api_key) {
        $this->api_key = $api_key;
    }

    // --------------------------------------------------------------------

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    
    function initialize($config = array()) {
        foreach ($config as $key => $val) {
            if (isset($this->$key)) {
                $this->$key = $val;
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Zwraca wygenerowaną mapę
     *
     * @access	public
     * @return	string
     */
    
    public function setApiUrl( $apiUrl ){
        
        $this->url = $apiUrl;
        
    }
    
    public function enableDrawingManager(){
        
        $this->drawingManager = true;
        
    }
    
    public function enablePolylinesCompleteListener(){
        
        $this->polylinesCompleteListener = true;
        
    }
    
    /**
     * 
     * Funkcja zwraca kod HTML dla google maps
     * 
     * @return html
     */
    public function getMap (){
        
        return $this->map;
        
    }
        
    /**
     * Funkcja generuje kod HTML
     * 
     */
    
    public function generateMap(){
        
        $map = '';
        $map .= '<script type="text/javascript" src="'.$this->url.'"></script>'."\n";
        $map .= '<script>';
        $map .= '';
        $map .= 'function initialize(){';
        $map .= 'var mapOptions = {';
        $map .= 'zoom: '.$this->zoom.',';
        $map .= 'center: new google.maps.LatLng('.$this->lat.','.$this->lon.')';
        $map .= '};';
        $map .= 'var map = new google.maps.Map(document.getElementById(\''.$this->div_id.'\'),mapOptions);';
        if( $this->drawingManager ){
        
            $map .= 'var drawingManager = new google.maps.drawing.DrawingManager({';
            $map .= 'drawingMode: google.maps.drawing.OverlayType.MARKER,';
            $map .= 'drawingControl: true,';
            $map .= 'drawingControlOptions: {';
            $map .= 'position: google.maps.ControlPosition.TOP_CENTER,';
            $map .= 'drawingModes: [';
            $map .= 'google.maps.drawing.OverlayType.MARKER,';
            $map .= 'google.maps.drawing.OverlayType.CIRCLE,';
            $map .= 'google.maps.drawing.OverlayType.POLYGON,';
            $map .= 'google.maps.drawing.OverlayType.POLYLINE,';
            $map .= 'google.maps.drawing.OverlayType.RECTANGLE';
            $map .= ']';
            $map .= '},';
            $map .= 'markerOptions: {';
            $map .= 'icon: \'/img/mufa-1.png\'';
            $map .= '},';
            $map .= 'circleOptions: {';
            $map .= 'fillColor: \'#ffff00\',';
            $map .= 'fillOpacity: 1,';
            $map .= 'strokeWeight: 5,';
            $map .= 'clickable: false,';
            $map .= 'editable: true,';
            $map .= 'zIndex: 1';
            $map .= '}';
            $map .= '});';
            $map .= 'drawingManager.setMap(map);';
                
        }
        
        $map .= '';
        if( $this->polylinesCompleteListener) {
            
            $map .= 'google.maps.event.addListener(drawingManager, \'polylinecomplete\', function(line) {'
                    . 'coordinates = line.getPath().getArray();'
                    . '});';
            
        }
        $map .= '';
        $map .= '};';
        $map .= '';
        $map .= 'google.maps.event.addDomListener(window, \'load\', initialize);';
        $map .= '';
        $map .= '</script>';
        
        $this->map = $map;
                
    }

}
