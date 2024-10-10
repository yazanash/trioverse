<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\License;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
class GymController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
        ])->get(env('API_BASE_URL').'gyms');
        if ($response->successful()) {
            $data = $response->json();
            $collection = collect($data);
            $gyms = collect([]);
            foreach ($collection as $item) {
                $gym = new Gym();
                $gym->gym_id = $item['id'];
                $gym->gym_name = $item['gym_name'];   
                $gym->owner_name = $item['owner_name'];
                $gym->phone_number = $item['phone_number'];   
                $gym->telephone = $item['telephone'];
                $gym->address = $item['address'];  
                $gym->logo = env('API_BASE_URL').'gyms/logos/' .$gym->gym_id ;
                $gyms->push($gym); 
            }
            return view('gyms.gyms',compact('gyms'));
        } else {
            // Handle the error
        //    return 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gyms.create');
    }
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gym_name' => 'required',
            'owner_name' => 'required',
            'phone_number' => 'required',
            'telephone' => 'required',
            'address' => 'required',
        ]);
        $input = $request->all();
        $response = Http::withHeaders([
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->post(env('API_BASE_URL').'gyms', [
            'gym_name' => $input['gym_name'],
            'owner_name' => $input['owner_name'],
            'phone_number' => $input['phone_number'],
            'telephone' => $input['telephone'],
            'address' => $input['address'],
            'logo' => ''
        ]);
        $gym_id = $response['gym_id'];
        return redirect()->route('gyms.image.create',$gym_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            
        ])->get(env('API_BASE_URL').'gyms/'. $id);
        $gym = new Gym();
        $gym->gym_id = $response['id'];
        $gym->gym_name = $response['gym_name'];   
        $gym->owner_name = $response['owner_name'];
        $gym->phone_number = $response['phone_number'];   
        $gym->telephone = $response['telephone'];
        $gym->address = $response['address'];  
        $gym->logo = env('API_BASE_URL').'gyms/logos/' .$response['id'] ;
        $licenses = collect([]);
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->get(env('API_BASE_URL').'licenses/gym/'. $id);
        if ($response->successful()) {
            
            $statusCode = $response->status();
            if($statusCode===200){
                $data = $response->json();
                $collection = collect($data);
                // dd($collection);
                foreach ($collection as $item) {
                    $license = new License();
                    $license->license_id = $item['_id'];
                    $license->gym_id = $item['gym_id'];   
                    $license->plan_id = $item['plan_id'];
                    $license->plan_name = $item['plan_name'];
                    $license->price = $item['price'];   
                    $license->subscribe_date =Carbon::parse($item['subscribe_date'])->format('Y-m-d');
                    $license->subscribe_end_date =Carbon::parse($item['subscribe_end_date'])->format('Y-m-d');
                    $license->period = $item['period'];
                    $licenses->push($license); 
                }
            }
           
        } else {
            // Handle the error
            echo 'Request failed with status: ' . $response->status();
        }
       

        return view('gyms.gym',compact('gym','licenses'));
        // return $gym;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $response = Http::withHeaders([
            'content-type' => 'application/json',
        ])->get(env('API_BASE_URL').'gyms/'. $id);
        $gym = new Gym();
        $gym->gym_id = $response['id'];
        $gym->gym_name = $response['gym_name'];   
        $gym->owner_name = $response['owner_name'];
        $gym->phone_number = $response['phone_number'];   
        $gym->telephone = $response['telephone'];
        $gym->address = $response['address'];  
        return view('gyms.edit',compact('gym'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'gym_name' => 'required',
            'owner_name' => 'required',
            'phone_number' => 'required',
            'telephone' => 'required',
            'address' => 'required',
        ]);
        $input = $request->all();
        $response = Http::withHeaders([
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->put(env('API_BASE_URL')."gyms/{$id}", [
            'gym_name' => $input['gym_name'],
            'owner_name' => $input['owner_name'],
            'phone_number' => $input['phone_number'],
            'telephone' => $input['telephone'],
            'address' => $input['address'],
            'logo' => ''
        ]);
        return redirect()->route('gyms.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gym $gym)
    {
        //
    }
}
