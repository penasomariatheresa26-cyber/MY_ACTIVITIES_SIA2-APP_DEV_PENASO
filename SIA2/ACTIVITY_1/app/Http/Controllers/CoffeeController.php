<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoffeeController extends Controller
{
    private $coffees = [
        ['id'=>1,'name'=>'Ethiopian Yirgacheffe','country'=>'Ethiopia','description'=>'Floral coffee with citrus flavor'],
        ['id'=>2,'name'=>'Colombian Supremo','country'=>'Colombia','description'=>'Smooth coffee with caramel sweetness'],
        ['id'=>3,'name'=>'Brazil Santos','country'=>'Brazil','description'=>'Nutty flavor with chocolate notes'],
        ['id'=>4,'name'=>'Sumatra Mandheling','country'=>'Indonesia','description'=>'Earthy and strong coffee taste'],
        ['id'=>5,'name'=>'Guatemala Antigua','country'=>'Guatemala','description'=>'Rich aroma with smoky chocolate flavor']
    ];

    // LIST PAGE
    public function index()
    {
        return view('coffees.index', [
            'coffees' => $this->coffees
        ]);
    }

    // DETAIL PAGE
    public function show($id)
    {
        $coffee = collect($this->coffees)->firstWhere('id', (int)$id);

        if (!$coffee) {
            abort(404);
        }

        return view('coffees.show', [
            'coffee' => $coffee
        ]);
    }
}