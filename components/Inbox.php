<?php namespace Nielsvandendries\Messenger\Components;

use Cms\Classes\ComponentBase;
use RainLab\User\Facades\Auth;
use Nielsvandendries\Messenger\Models\Messages;
use RainLab\User\Models\User;

class Inbox extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'inbox Component',
            'description' => 'No description provided yet...'
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
                $message->sender_name = $sender ? $sender->name : 'Onbekende verzender';                
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
            // Gebruiker is niet ingelogd, doe iets (bijv. redirect naar inlogpagina)
            return;
        }
    
        $messageId = post('messageId');
        $message = Messages::find($messageId);
    
        if (!$message) {
            // Bericht niet gevonden, doe iets (bijv. toon een foutmelding)
            return;
        }
    
        if ($message->recipient_id !== $user->id) {
            // Huidige gebruiker is niet de ontvanger van het bericht, doe iets (bijv. toon een foutmelding)
            return;
        }
    
        $message->delete();
    
        // Toon een succesbericht of voer andere acties uit na het verwijderen van het bericht
        Flash::success('Bericht succesvol verwijderd!');
        $this->page['messages'] = $this->getMessages();
    }
    


}
