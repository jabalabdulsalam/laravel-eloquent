<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonTest extends TestCase
{
    public function testPerson()
    {
        $person = new Person();
        $person->first_name = "Jabal";
        $person->last_name = "Salam";
        $person->save();

        self::assertEquals("JABAL Salam", $person->full_name);

        $person->full_name = "Darmisah Hanum";
        $person->save();

        self::assertEquals("DARMISAH", $person->first_name);
        self::assertEquals("Hanum", $person->last_name);
    }

    public function testAttributeCasting()
    {
        $person = new Person();
        $person->first_name = "Jabal";
        $person->last_name = "Salam";
        $person->save();

        self::assertNotNull($person->created_at);
        self::assertNotNull($person->updated_at);
        self::assertInstanceOf(Carbon::class, $person->created_at);
        self::assertInstanceOf(Carbon::class, $person->updated_at);
    }

    public function testCustomCast()
    {
        $person = new Person();
        $person->first_name = "Jabal";
        $person->last_name = "Salam";
        $person->address = new Address("Lorong Bina Karya", "Nagan Raya", "Indonesia", "23661" );
        $person->save();

        self::assertNotNull($person->created_at);
        self::assertNotNull($person->updated_at);
        self::assertInstanceOf(Carbon::class, $person->created_at);
        self::assertInstanceOf(Carbon::class, $person->updated_at);
        self::assertEquals("Lorong Bina Karya", $person->address->street);
        self::assertEquals("Nagan Raya", $person->address->city);
        self::assertEquals("Indonesia", $person->address->country);
        self::assertEquals("23661", $person->address->postal_code);
    }


}
