<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Update;
use Illuminate\Support\Facades\Response;
class UpdateController extends Controller
{
    public function index()
    {
        $updates = Update::all();
        return view('desktop.index',compact('updates'));
    }
    public function create()
    {
        return view('desktop.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'version' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'description' => 'required',
            'platform' => 'required',
        ]);

        Update::create([
            'version' => $request->version,
            'url' => $request->url,
            'description' => $request->description,
            'platform' => $request->platform,
        ]);

        return redirect()->route('updates.create')->with('success', 'Update added successfully!');
    }
    public function getDesktopUpdateInfo()
    {
        $latestUpdate = Update::where('platform', 'desktop')->latest()->first();
        if ($latestUpdate !== null && $latestUpdate->count() > 0) {
            $xml = new \SimpleXMLElement('<Update/>');
            $xml->addChild('Version', $latestUpdate->version);
            $xml->addChild('Url', $latestUpdate->url);
            $xml->addChild('Description', $latestUpdate->description);
            return Response::make($xml->asXML(), 200)->header('Content-Type', 'application/xml');
        } 
       
        $message = ["message"=>"NotFound"];
        return response()->json($message, 404);
    }
    public function getMobileUpdateInfo(string $platform)
    {
        $latestUpdate = Update::where('platform', 'mobile')->latest()->first();
        if($latestUpdate !== null&&$latestUpdate->count()>0){
            $store = env('PLAY_STORE_URL',null);
            if($platform === 'I')
                $store = env('APP_STORE_URL',null);

            $data = [
                'version'=> $latestUpdate->version,
                'url'=> $latestUpdate->url,
                'store'=>  $store,
            ];
            return response()->json($data, 200);
        }
        
        $message = ["message"=>"NotFound"];
        return response()->json($message, 404);
    }
    
}
