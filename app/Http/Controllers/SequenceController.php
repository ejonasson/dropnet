<?php

namespace App\Http\Controllers;

use App\Integrations\Stripe\Api;
use App\Models\Business\Business;
use App\Models\Emails\Sequence;
use Illuminate\Http\Request;

class SequenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = Business::current();
        $sequences = $business->sequences()->get();

        return view('business.sequences.index', compact('business', 'sequences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business = Business::current();
        $api      = Api::instance();
        $plans    = $api->getAllSubscriptionPlans();

        return view('business.sequences.create', compact('business', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @todo  add middleware check confirming user can access this sequence
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * @todo  add middleware check confirming user can access this sequence
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        $sequence  = Sequence::findOrFail($id);
        $data = collect([
            'sequence' => $sequence,
            'emails'   => $sequence->emails
        ]);

        $business = Business::current();
        $api      = Api::instance();
        $plans    = $api->getAllSubscriptionPlans();

        return view('business.sequences.edit', compact('business', 'data', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
