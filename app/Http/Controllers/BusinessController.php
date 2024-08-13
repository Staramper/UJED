<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SaveBusinessRequest;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role == 'admin'){
            // $businesses = Business::all();
            $businesses = Business::select('businesses.*', 'nick')
                ->join('users', 'users.id', '=', 'businesses.bsn_socio')
                ->get();
        } else {
            $businesses = Business::where('bsn_socio','=', auth()->user()->id)->get(); 
            // $businesses = Business::select('businesses.*', 'nick')
            //     ->join('users', 'users.id', '=', 'businesses.bsn_socio')
            //     ->where('id','=', auth()->user()->id)
            //     ->get();
        }
        
        return $businesses;
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
    public function store(SaveBusinessRequest $request)
    {
        $business = new Business;
        $bsnSave = $request->validated();
        $bsnSave['bsn_logo'] = '';
        $business->create($bsnSave);
        $bIdn = Business::latest('id')->first()->id;
        // Guardado de Logo
        $bId = str_pad($bIdn,3,'0',STR_PAD_LEFT).'000.png';
        $file = $request->bsn_logo;

        if(strlen($file) > 15){
            $file = substr($file, strpos($file, ',') + 1);
            Storage::put($bId, base64_decode($file));
        }
        $bsnSave['bsn_logo'] = $bId;
        $business = Business::find($bIdn);
        $business->update($bsnSave);
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        return $business;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveBusinessRequest $request, Business $business)
    {
        //Codigo para obtener imagen 
        $bId = strval($business->id);
        $bId = str_pad($bId,3,'0',STR_PAD_LEFT).'000.png';
        $file = $request->bsn_logo;
        // return $request;
        if(strlen($file) > 15){
            $file = substr($file, strpos($file, ',') + 1);
            Storage::put($bId, base64_decode($file));
        }
        $bsnSave = $request->all();
        $bsnSave['bsn_logo'] = $bId;

        $business->update($bsnSave);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        $business->delete();
    }
}
