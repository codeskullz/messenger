<?php namespace NielsVanDenDries\Messenger\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Auth;
use RainLab\User\Models\User;

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

    protected $fillable = ['sender_id', 'recipient_id', 'content'];

    public static function createMessage($senderId, $recipientId, $content)
    {
        $message = new self();
        $message->sender_id = $senderId;
        $message->recipient_id = $recipientId;
        $message->content = $content;
        $message->save();

        return $message;
    }

    public function sendMessage()
    {
        $recipientId = post('recipient_id');
        $messageContent = post('message_content');

        $senderId = Auth::getUser()->id;

        $message = Messages::createMessage($senderId, $recipientId, $messageContent);

        Flash::success('Bericht succesvol verzonden!');
    }

    public function onRender()
    {
        $this->page['users'] = User::all();
    }

}
