<?php
namespace App\Mail;
use App\Models\Bike;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Congratulation extends Mailable {
    use Queueable, SerializesModels;
    public $bike;

    public function __construct(Bike $bike){
        $this->bike = $bike;
    }

    public function build() {
        return $this->from('no-reply@larabikes.com')
                ->subject('¡Felicidades!')
                ->view('emails.congratulation');
    }
}