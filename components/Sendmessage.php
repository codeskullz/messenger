<?php namespace Nielsvandendries\Messenger\Components;

use Cms\Classes\ComponentBase;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\User;
use Nielsvandendries\Messenger\Models\Messages;
use October\Rain\Support\Facades\Flash;

class Sendmessage extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'sendmessage Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public static function createMessage($senderId, $recipientId, $content)
    {
        $message = new Messages();
        $message->sender_id = $senderId;
        $message->recipient_id = $recipientId;
        $message->content = $content;
        $message->save();
    
        return $message;
    }

    public function onRender()
    {
        $this->page['users'] = User::all();
    }

    public function onSendMessage()
    {
        $recipientId = post('recipient_id');
        $messageContent = post('message_content');
    
        $senderId = Auth::getUser()->id;
    
        $message = self::createMessage($senderId, $recipientId, $messageContent);
    
        Flash::success('Message successfully sent!');

        return redirect()->refresh();
    }
    

}
