<?php namespace NielsVanDenDries\Messenger\Models;

// this code was written by Niels van den Dries (NvandenDries.nl) for OctoberCMS v3, 
// if you want more info about this plugin you can reach me at niels@nvandendries.nl

use Model;
use RainLab\User\Models\User;

/**
 * Model
 */
class Messages extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'nielsvandendries_messenger_message';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public static function deleteMessage($messageId)
    {
        $message = self::find($messageId);
    
        if (!$message) {
            return false;
        }
    
        $message->delete();
    
        return true;
    }

    public $attributes = [
        'is_read' => 0,
    ];
    
    public static function createMessage($senderId, $recipientId, $content)
    {
        $message = new self();
        $message->sender_id = $senderId;
        $message->recipient_id = $recipientId;
        $message->content = $content;
        $message->is_read = 0;
        $message->save();

        return $message;
    }
    
    public $belongsTo = [
        'sender' => ['RainLab\User\Models\User', 'key' => 'sender_id'],
        'recipient' => ['RainLab\User\Models\User', 'key' => 'recipient_id'],
    ];

    public static function findWithNames($messageId)
    {
        $message = self::with(['sender', 'recipient'])->find($messageId);

        if (!$message) {
            return null;
        }

        $senderName = $message->sender ? $message->sender->name : 'Unknown sender';
        $recipientName = $message->recipient ? $message->recipient->name : 'Unknown recipient';

        $message->sender_name = $senderName;
        $message->recipient_name = $recipientName;

        return $message;
    }
}
