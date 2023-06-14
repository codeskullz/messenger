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
        $message = Messages::deleteMessage($messageId);
    
        if (!$message) {
            // Bericht niet verwijderd, doe iets (bijv. toon een foutmelding)
            return;
        }
    
        // Toon een succesbericht of voer andere acties uit na het verwijderen van het bericht
        Flash::success('Bericht succesvol verwijderd!');
        $this->page['messages'] = $this->getMessages();

        return redirect()->refresh();
    }
    
}
