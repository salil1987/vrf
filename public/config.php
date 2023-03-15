<?php

define("VR_URL", "https://vrboconnector.vrmanaged.com/");

define("HI_URL", "https://hivrbo.vrmanaged3.com");

define("SI_URL", "https://sivrbo.vrmanaged3.com/");

class vrConfig{

    private $data = null;

    function __construct()
    {
        if(!isset($this->data)){
            $this->set();
        }
        
    }

    function set(){

        $data = array();

        $data['VR']['URL'] = VR_URL;
        $data['HI']['URL'] = HI_URL;
        $data['SI']['URL'] = SI_URL;

        $this->data = $data;
    }


    function get(){
        return $this->data;
    }
}