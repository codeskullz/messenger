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
            // Bericht niet gevonden, doe iets (bijv. toon een foutmelding)
            return false;
        }
    
        $message->delete();
    
        return true;
    }

}
