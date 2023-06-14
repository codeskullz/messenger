<?php namespace NielsVanDenDries\Messenger\Components;

use Cms\Classes\ComponentBase;

class Messages extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Messages Frontend Component',
            'description' => 'The place where the can add messages'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
}
