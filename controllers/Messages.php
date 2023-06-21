<?php namespace NielsVanDenDries\Messenger\Controllers;

// this code was written by Niels van den Dries (NvandenDries.nl) for OctoberCMS v3, 
// if you want more info about this plugin you can reach me at niels@nvandendries.nl

use Backend\Classes\Controller;
use BackendMenu;

class Messages extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'manager' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('NielsVanDenDries.Messenger', 'main-menu-item', 'side-menu-item');
    }
}
