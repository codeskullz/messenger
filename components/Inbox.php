<?php namespace Nielsvandendries\Messenger\Components;

use Cms\Classes\ComponentBase;

/**
 * Inbox Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Inbox extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'inbox Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [];
    }
}
