<?php

namespace App\Http\Controllers;

use App\Models\Queja;
use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Requests\SaveQuejaRequest;

class QuejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role == 'admin'){
            $quejas = Queja::all();
            // $quejas = Business::select('businesses.*', 'nick')
            //     ->join('users', 'users.id', '=', 'businesses.bsn_socio')
            //     ->get();
        } else {
            $quejas = Queja::where('qjs_user','=', auth()->user()->id)->get(); 
        }
        return $quejas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveQuejaRequest $request)
    {
        $quejas = new Queja;
        $quejas->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Queja $queja)
    {
        return $queja;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Queja $queja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveQuejaRequest $request, Queja $queja)
    {
        $queja->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Queja $queja)
    {
        $queja->delete();
    }
}
