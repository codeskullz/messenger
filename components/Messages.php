<?php namespace NielsVanDenDries\Messenger\Components;

use Cms\Classes\ComponentBase;

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

    public function onSaveMessage()
    {
        $message = new Message;
        $message->subject = post('subject');
        $message->message = post('message');
        $message->save();

        // Eventuele extra acties na het opslaan van het bericht

        \Flash::success('Bericht is succesvol opgeslagen.');
        trace_log('Bericht opgeslagen: ' . post('subject') . ' - ' . post('message'));

    }
}
