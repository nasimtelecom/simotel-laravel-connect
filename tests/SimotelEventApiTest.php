<?php

namespace Nasim\Simotel\Laravel\Tests;


use Illuminate\Support\Facades\Event;
use Nasim\Simotel\Laravel\Facade\Simotel;

class SimotelEventApiTest extends TestCase
{

    public function testCdr()
    {
        Event::fake();

        $events = [
            "CDR", "NewState", "IncomingCall", "OutgoingCall", "Transfer", "ExtenAdded", "ExtenRemoved",
            "IncomingFax", "IncomingFax", "CdrQueue", "VoiceMail", "VoiceMailEmail", "Survey"
        ];

        foreach ($events as $event) {
            Simotel::eventApi()->dispatch($event, []);

            $eventClassName = "Nasim\Simotel\Laravel\Events\SimotelEvent" . $event;
            Event::assertDispatched($eventClassName);
        }
    }

}
