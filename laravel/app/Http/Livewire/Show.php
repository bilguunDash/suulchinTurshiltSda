<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserChat extends Component
{
    public $message = '';

       public function render()
       {
           return view('livewire.user-chat');
       }

    protected $listeners = ['messageReceived' => 'receiveMessage'];

        public function receiveMessage($message)
        {
            // Handle received message
        }

        public function sendMessage()
        {
            // Send message logic

            // Broadcast the message to the admin
            event(new MessageReceived($this->message));

            // Clear the input field
            $this->message = '';
        }
}
