<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotifyController extends Controller
{
    public function createGymNotify($gym_id)
    {
        return view('gyms.notify',compact('gym_id'));
    }
    public function createNotify()
    {
        return view('notify');
    }
    public function gymPlayers(Request $request,string $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $input = $request->all();
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->post(env('API_BASE_URL')."handshake/{$id}/notify", [
            'title' => $input['title'],
            'body' => $input['body'],
        ]);
        $message = $response->json();
        return redirect()->route('gyms.show',$id)->with('success', $message['message']);
    }
    public function allPlayers(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $input = $request->all();
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->post(env('API_BASE_URL')."handshake/notify", [
            'title' => $input['title'],
            'body' => $input['body'],
        ]);
        // dd($response->json());
        $message = $response->json();
        return redirect()->back()->with('success', $message['message']);
    }

}
