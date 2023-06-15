<?php namespace NielsVanDenDries\Messenger\Models;

use Model;

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
}
