<?php

namespace Nasim\LaraSimotel\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Nasim\LaraSimotel\Events\SimotelEventCDR;
use Nasim\LaraSimotel\Facade\Simotel;

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

            $eventClassName = "Nasim\LaraSimotel\Events\SimotelEvent" . $event;
            Event::assertDispatched($eventClassName);
        }
    }

}
