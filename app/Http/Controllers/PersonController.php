<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // METODO GET
    {
        $persons = Person::all();

        $res = [
            "status" => "ok",
            "message" => "Lista de personas",
            "code" => 1000,
            "data" => $persons
        ];

        return $res;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // METODO POST
    {
        $jsonPerson = $request->json()->all();

        ############################################################
        # Automatico (indicar fillables en el modelo Person):

        $person = new Person($jsonPerson);

        ############################################################
        # Manualmente (no son necesarios los fillables):

        //$person = new Person();

        // $person->firstName = $jsonPerson["firstName"];
        // $person->lastName = $jsonPerson["lastName"];
        // $person->documentNumber = $jsonPerson["documentNumber"];
        // $person->country = $jsonPerson["country"];
        // $person->city = $jsonPerson["city"];
        // $person->street = $jsonPerson["street"];
        // $person->number = $jsonPerson["number"];
        // $person->single = $jsonPerson["single"];

        ############################################################

        $res = [
            "status" => "ok",
            "message" => "Persona Creada",
            "code" => 1003,
            "data" => $person
        ];

        return $res;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // METODO GET
    {
        $person = Person::find($id);

        if(isset($person)) {
            $res = [
                "status" => "ok",
                "message" => "Obteniendo persona por ID " . $id,
                "code" => 1001,
                "data" => $person
            ];
        } else {
            $res = [
                "status" => "error",
                "message" => "No se ha encontrado una persona con ID " . $id,
                "code" => 1011,
                "data" => $person
            ];
        }

        return $res;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // METODO PUT
    {
        $person = Person::find($id);

        if(isset($person)) {
            $person->update($request->json()->all());
            $res = [
                "status" => "ok",
                "message" => "Persona Actualizada",
                "code" => 1005
            ];
            $person->save();
        } else {
            $res = [
                "status" => "error",
                "message" => "No se ha encontrado una persona con ID " . $id,
                "code" => 1015
            ];
        }

        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // METODO DELETE
    {
        $person = Person::find($id);

        if(isset($person)) {
            $person->delete();
            $res = [
                "status" => "ok",
                "message" => "Persona Eliminada",
                "code" => 1004
            ];
        } else {
            $res = [
                "status" => "error",
                "message" => "No se ha encontrado una persona con ID " . $id,
                "code" => 1014
            ];
        }

        return $res;
    }
}
