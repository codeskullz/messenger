<?php namespace Nielsvandendries\Messenger\Components;

use Cms\Classes\ComponentBase;
use RainLab\User\Facades\Auth;
use Nielsvandendries\Messenger\Models\Messages;
use RainLab\User\Models\User;
use October\Rain\Support\Facades\Flash;

class Inbox extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'inbox',
            'description' => 'Your Messages'
        ];
    }

    public function defineProperties()
    {
        return [
            'showReplyFields' => [
                'title' => 'Show answer fields',
                'description' => 'Toggle on or off to display the answer fields',
                'type' => 'checkbox',
                'default' => false,
            ]
        ];
    }

    public function getMessages()
    {
        $user = Auth::getUser();
    
        if ($user) {
            $messages = Messages::where('recipient_id', $user->id)->get();
    
            foreach ($messages as $message) {
                $sender = User::find($message->sender_id);
                $message->sender_name = $sender ? $sender->name : 'Unknown sender';                
            }
    
            return $messages;
        }
    
        return [];
    }

    public function onRender()
    {
        $this->page['messages'] = $this->getMessages();
        $this->page['onReplyMessage'] = $this->alias.'::onReplyMessage';
        $this->page['showReplyFields'] = $this->property('showReplyFields');
    }

    public function onDeleteMessage()
    {
        $user = Auth::getUser();
    
        if (!$user) {
            return;
        }
    
        $messageId = post('messageId');
        $message = Messages::deleteMessage($messageId);
    
        if (!$message) {
            return;
        }
    
        Flash::success('Message deleted successfully!');
        $this->page['messages'] = $this->getMessages();

        return redirect()->refresh();
    }

    public function onReadMessage()
    {
        $messageId = post('messageId');

        $message = Messages::find($messageId);

        if ($message) {
            $message->is_read = true;
            $message->save();
        }
        return redirect()->refresh();
    }

    public function onReplyMessage()
    {
        $messageId = post('messageId');
        $messageContent = post('messageContent');

        $message = Messages::find($messageId);

        if ($message) {
            $senderId = Auth::getUser()->id;
            $recipientId = $message->sender_id;

            Messages::createMessage($senderId, $recipientId, $messageContent);

            Flash::success('Message deleted successfully!');
        }
        return redirect()->refresh();
    }
}
