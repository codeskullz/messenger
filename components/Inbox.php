<?php namespace Nielsvandendries\Messenger\Components;

use Cms\Classes\ComponentBase;
use RainLab\User\Facades\Auth;
use Nielsvandendries\Messenger\Models\Messages;


class Inbox extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'inbox Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function getMessages()
    {
        $user = Auth::getUser();

        if ($user) {
            return Messages::where('recipient_id', $user->id)->get();
        }

        return [];
    }

    public function onRender()
    {
        $this->page['messages'] = $this->getMessages();
    }


}
