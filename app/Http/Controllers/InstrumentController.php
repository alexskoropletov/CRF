<?php

namespace App\Http\Controllers;

use App\Instrument;
use Illuminate\Http\Request;

use App\Http\Requests;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Instrument::orderBy("for_fann", "desc")
            ->orderBy("update", "desc")
            ->orderBy("id", "asc")
            ->paginate(50);
        $page = (int)$request->get('page') ? (int)$request->get('page') : 0;
        return view('instrument.index', compact("items", "page"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $page = $request->query->get('page');
        $instrument = Instrument::find($id);
        $instrument->update = !$instrument->update;
        $instrument->save();
        return redirect('/instrument' . ($page ? "?page=" . $page: ""));
    }
    public function fann(Request $request, $id)
    {
        $page = $request->query->get('page');
        $instrument = Instrument::find($id);
        $instrument->for_fann = !$instrument->for_fann;
        $instrument->save();
        return redirect('/instrument' . ($page ? "?page=" . $page: ""));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //useless by now
    }
}
