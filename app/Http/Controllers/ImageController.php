<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create($gym_id)
    {
        return view('gyms.uploadimg',compact('gym_id'));
    }
    public function store(Request $request, $gym_id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        $imagePath = $request->file('image')->store('images', 'public');
    
        // Send image to Flask API
        $this->sendToFlaskAPI($imagePath,$gym_id);
    
        return redirect()->route('gyms.show',$gym_id);
    }
    
    private function sendToFlaskAPI($imagePath,$gym_id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->post(env('API_BASE_URL').'gyms/upload', [
            'headers' => [
            'X-API-KEY' => env('FLASK_API_KEY'),
            ],
            'multipart' => [
                [
                    'name'     => 'gym_id',
                    'contents' => $gym_id
                ],
                [
                    'name'     => 'file',
                    'contents' => fopen(storage_path('app/public/' . $imagePath), 'r'),
                    'filename' => basename($imagePath)
                ],
            ],
            
        ]);
    }
}
