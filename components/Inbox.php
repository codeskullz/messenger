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
        return [];
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

    public function onSendReply()
    {
        $recipientId = post('recipientId');
        $messageContent = post('messageContent');
        $senderId = Auth::getUser()->id;
    
        Messages::createMessage($senderId, $recipientId, $messageContent);
    
        Flash::success('Message successfully sent!');
        $this->page['modalVisible'] = false;
    
        $this->page['messages'] = $this->getMessages();
        return $this->renderPartial('inbox/default');
    }

    public function onReplyMessage()
    {
        $recipientId = post('recipientId');
        $messageContent = post('messageContent');
        $senderId = Auth::getUser()->id;
    
        Messages::createMessage($senderId, $recipientId, $messageContent);
    
        Flash::success('Message successfully sent!');
        $this->page['modalVisible'] = false;
    
        $this->page['messages'] = $this->getMessages();
        return $this->renderPartial('inbox/default');
    }
    
}
