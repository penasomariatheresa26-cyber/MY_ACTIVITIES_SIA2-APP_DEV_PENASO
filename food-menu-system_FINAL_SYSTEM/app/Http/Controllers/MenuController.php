<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem; // Imported your MenuItem model so Laravel can find it

class MenuController extends Controller
{
    /**
     * Display a listing of the menu items.
     */
    public function index()
    {
        // Fetches all records from the menu_items table
        $menuItems = MenuItem::all();

        // Passes the records to your resources/views/menu.blade.php file
        return view('menu', compact('menuItems'));
    }
}