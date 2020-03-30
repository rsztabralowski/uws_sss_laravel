<?php

namespace App\Http\Controllers;

use App\Fact;
use App\Services\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreFactRequest;
use App\Http\Requests\UpdateFactRequest;


class FactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facts = Fact::orderBy('created_at' , 'desc')->paginate(5);

        return view('main')->with('facts', $facts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFactRequest $request)
    {
        // Create Fact
        $fact = new Fact;
        $fact->description = $request->input('description');
        $fact->user_id = auth()->user()->id;
        $fact->photo_path = UploadFileService::getFileName($request->file('fact_image'));
        $fact->save();

        return redirect('/account')->with('success', 'Fact Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function show(Fact $fact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function edit(Fact $fact)
    {
        return view('fact.edit')->with('fact', $fact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFactRequest $request, Fact $fact)
    {
        // Handle File Upload
        if($request->hasFile('fact_image'))
        {
            $fact->photo_path = UploadFileService::getFileName($request->file('fact_image'), $fact->photo_path);
        } 
        
        //Update fact
        $fact->description = $request->input('description');
        $fact->save();

        return redirect('/account')->with('success', 'Fact Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fact $fact)
    {
        $fact = Fact::find($fact->id);
        
        Storage::delete('public/facts_images/'.$fact->photo_path);
        
        $fact->delete();
        return redirect('/account')->with('success', 'Fact Removed');
    }
}
