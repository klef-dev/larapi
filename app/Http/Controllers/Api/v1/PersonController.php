<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonResourceCollection;
use App\Person;

class PersonController extends Controller
{

    /**
     * @param Person $person
     * @return PersonResource
     */
    public function show(Person $person): PersonResource {
        return new PersonResource($person);
    }

    /**
     * @return PersonResourceCollection
     */
    public function index():PersonResourceCollection {
        return new PersonResourceCollection(Person::paginate());
    }

    public function store(Request $request) {
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required",
            "phone" => "required",
            "city" => "required",
        ]);

        $person = Person::create($request->all());

        return new PersonResource($person);
    }

    public function update(Person $person, Request $request): PersonResource {
        $person->update($request->all());

        return new PersonResource($person);
    }

    public function destroy(Person $person) {
        $person->delete();

        return response()->json();
    }
}
