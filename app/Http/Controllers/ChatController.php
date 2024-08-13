<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Business;
use App\Http\Requests\SaveChatRequest;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chats = Chat::select('cht_orig','cht_dest','cht_business','uorg.nick as norg','udes.nick as ndes','bsn_title')
        ->join('users as uorg', 'uorg.id', '=', 'chats.cht_orig')
        ->join('users as udes', 'udes.id', '=', 'chats.cht_dest')
        ->join('businesses', 'businesses.id', '=', 'chats.cht_business')
        ->where('bsn_socio','=', auth()->user()->id)
        ->where('uorg.id','!=', auth()->user()->id)
        ->orderBy('cht_fecha_hora')->distinct()
        ->get();

        return $chats;
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
    public function store(SaveChatRequest $request)
    {
        $dataReq = $request->validated();
        //return $dataReq;
        $chats = new Chat;
        $chatSave['cht_orig'] = auth()->user()->id;
        $chatSave['cht_dest'] = $dataReq['cht_dest'];
        $chatSave['cht_fecha_hora'] = date("Y-m-d h:i:s"); ;
        $chatSave['cht_business'] = $dataReq['cht_business'];
        $chatSave['cht_message'] = $dataReq['cht_message'];

        $chats->create($chatSave);
    }

    /**
     * Display the specified resource.
     */
    public function show($chat)
    {
        // dd($chat);
        $chats = Chat::select('cht_orig','cht_dest','cht_business','cht_message','cht_fecha_hora','uorg.nick as norg','udes.nick as ndes','bsn_title')
        ->join('users as uorg', 'uorg.id', '=', 'chats.cht_orig')
        ->join('users as udes', 'udes.id', '=', 'chats.cht_dest')
        ->join('businesses', 'businesses.id', '=', 'chats.cht_business')
        ->where('bsn_socio','=', auth()->user()->id)
        // ->orWhere('uorg.id','!=', auth()->user()->id)
        ->where(function($query) use ($chat) {
            $query->where('cht_orig', '=', $chat)
                  ->orWhere('cht_dest', '=', $chat);
        })->orderBy('cht_fecha_hora')->orderBy('chats.id', 'asc')->distinct()
        ->get();

        return $chats;
    }

    public function chatcli($bsn, $chat)
    {
        // dd($chat);
        $user = auth()->user()->id;
        // dd($user);
        $chats = Chat::select('cht_orig','cht_dest','cht_business','cht_message','cht_fecha_hora','uorg.nick as norg','udes.nick as ndes','bsn_title')
        ->join('users as uorg', 'uorg.id', '=', 'chats.cht_orig')
        ->join('users as udes', 'udes.id', '=', 'chats.cht_dest')
        ->join('businesses', 'businesses.id', '=', 'chats.cht_business')
        ->where('businesses.id','=', $bsn)
        // ->orWhere('uorg.id','!=', auth()->user()->id)
        ->where(function($query) use ($user, $chat) {
            $query->where('cht_orig', '=', $user)
                  ->orWhere('cht_dest', '=', $user);
        })

        ->orderBy('cht_fecha_hora')->orderBy('chats.id', 'asc')->distinct()
        ->get();

        return $chats;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
