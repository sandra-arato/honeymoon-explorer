<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Entry;

class EntryController extends BaseController
{

    /**
     * Send back all entries as JSON
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(Entry::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        return response()->json(Entry::create($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return response()->json(Entry::destroy($id));
    }
}
