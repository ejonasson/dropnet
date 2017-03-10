<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Business\Business;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function show($slug)
    {
        $business = Business::fromSlug($slug);

        $settings = $business->settings;

        return view('business.settings', compact('business', 'settings'));
    }

    public function update($slug, Request $request)
    {
        $business = Business::fromSlug($slug);
        $business->updateSettings($request->all());

        return response()->json($business);
    }
}
