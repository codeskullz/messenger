<?php namespace NielsVanDenDries\Messenger;

// this code was written by Niels van den Dries (NvandenDries.nl) for OctoberCMS v3, 
// if you want more info about this plugin you can reach me at niels@nvandendries.nl

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'NielsVanDenDries\Messenger\Components\Sendmessage' => 'Sendmessage',
            'NielsVanDenDries\Messenger\Components\Inbox' => 'Inbox',
            'NielsVanDenDries\Messenger\Components\Notification' => 'Notification'
        ];
    }

    public function registerSettings()
    {
    }
}
