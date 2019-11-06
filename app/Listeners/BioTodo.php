<?php

namespace App\Listeners;

use App\Events\BioEvent;
use App\Models\Api\BiographyModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BioTodo
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BioEvent  $event
     * @return void
     */
    public function handle(BioEvent $event)
    {
        $bio = BiographyModel::where('user_id',$event->user->id);
        $bio->biography_content="merhaba";
        $bio->save();
    }
}
