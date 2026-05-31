<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class HomeRedirectController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.panel'),
            'supplier' => redirect()->route('supplier.panel'),
            default => redirect()->route('customer.panel'),
        };
    }
}