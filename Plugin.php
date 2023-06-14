<?php namespace NielsVanDenDries\Messenger;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'NielsVanDenDries\Messenger\Components\Sendmessage' => 'Sendmessage',
            'NielsVanDenDries\Messenger\Components\Inbox' => 'Inbox'
        ];
    }

    public function registerSettings()
    {
    }
}
