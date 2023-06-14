<?php namespace Nielsvandendries\Messenger\Components;

use Cms\Classes\ComponentBase;
use RainLab\User\Facades\Auth;
use Nielsvandendries\Messenger\Models\Messages;

class Notification extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Notification',
            'description' => 'Shows the number of new messages.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function isNewMessageAvailable()
    {
        $user = Auth::getUser();
    
        if ($user) {
            $count = Messages::where('recipient_id', $user->id)
                ->where('is_read', 0)
                ->count();
    
            return $count > 0;
        }
    
        return false;
    }

    public function getNewMessageCount()
    {
        $user = Auth::getUser();

        if ($user) {
            $count = Messages::where('recipient_id', $user->id)
                ->where('is_read', 0)
                ->count();

            return $count;
        }

        return 0;
    }

    public function onRender()
    {
        $this->page['isNewMessageAvailable'] = $this->isNewMessageAvailable();
        $this->page['newMessageCount'] = $this->getNewMessageCount();
    }

}
