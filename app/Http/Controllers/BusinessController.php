<?php

namespace App\Http\Controllers;

use App\Models\Business\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Load the Homepage for the Business, based on the slug.
     * @todo  Restrict this via login
     * @return View
     */
    public function show()
    {
        $business = Business::current();
        return view('business.home', compact('business'));
    }
}
