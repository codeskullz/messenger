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
        $message = new Messages();
        $message->subject = post('subject');
        $message->message = post('message');
        $message->save();

        // Eventuele verdere logica of omleiding na het opslaan van het bericht

        // Optioneel: Maak een succesmelding om te tonen aan de gebruiker
        Flash::success('Bericht succesvol opgeslagen.');

        // Optioneel: Omleiden naar een andere pagina na het opslaan van het bericht
        // return Redirect::to('success-page');

        trace_log('Model geladen: ' . get_class(new Messages()));
    }
}
