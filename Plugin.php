<?php namespace NielsVanDenDries\Messenger;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'NielsVanDenDries\Messenger\Components\Messages' => 'messages'
        ];
    }

    public function registerSettings()
    {
    }
}
