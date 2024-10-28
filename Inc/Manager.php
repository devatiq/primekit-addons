<?php 
namespace PrimeKit;

use PrimeKit\Public\Elementor\Configuration;
class Manager {

    protected $Elementor_Config;

    public function __construct() {
        $this->init();
    }

    public function init() {
      $this->Elementor_Config =  Configuration::instance();
    }
}