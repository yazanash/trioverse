<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Plan;
use App\Models\Gym;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $gym_id)
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->get(env('API_BASE_URL').'plans');
        if ($response->successful()) {
            $data = $response->json();
            $collection = collect($data);
            $plans = collect([]);
            $pos = 0;
            foreach ($collection as $item) {
                $plan = new Plan();
                $plan->plan_id = $item['id'];
                $plan->index = $pos++;
                $plan->plan_name = $item['plan_name'];   
                $plan->price = $item['price'];
                $plan->period = $item['period'];   
                $plan->description = $item['description'];
                $plans->push($plan); 
            }
        }
        return view('licenses.create',compact('gym_id','plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , string $gym_id)
    {
        // dd($request);
        $request->validate([
            'plan_id' => 'required',
            'subscribe_date' => 'required',
        ]);
       
        $input = $request->all();
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->post(env('API_BASE_URL').'licenses', [
            'gym_id' => $gym_id,
            'plan_id' => $input['plan_id'],
            'subscribe_date' => Carbon::parse($input['subscribe_date']),
        ]);
        $data = $response->json();
        // get gym 
        $response = Http::withHeaders([
            'content-type' => 'application/json',
        ])->get(env('API_BASE_URL').'gyms/'. $gym_id);
        $gym = new Gym();
        $gym->gym_id = $response['id'];
        $gym->gym_name = $response['gym_name'];   
        $gym->owner_name = $response['owner_name'];
        $gym->phone_number = $response['phone_number'];   
        $gym->telephone = $response['telephone'];
        $gym->address = $response['address'];  
        $gym->logo = env('API_BASE_URL').'gyms/logos/' .$response['id'] ;

        // get license
        $license = new License();
        $license->plan_id = $data['plan_id'];   
        $license->subscribe_date = $data['subscribe_date'];
        $license->subscribe_end_date = $data['subscribe_end_date'];
        $license->price = $data['price'];
        $license->period = $data['period'];
        $license->product_key = $data['product_key'];
        // get plan info
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->get(env('API_BASE_URL').'plans/'.  $license->plan_id);
        $plan = new Plan();
        $plan->plan_id = $response['id'];
        $plan->plan_name = $response['plan_name'];   
        $plan->price = $response['price'];
        $plan->period = $response['period'];   
        $plan->description = $response['description'];
        // $pdf = Pdf::loadView('pdf.license',compact('gym','license','plan'))->setOption(['dpi' => 150]);
        // $pdf->setBasePath(public_path());
        return view('pdf.license',compact('gym','license','plan'));
        // $pdf->download($gym->gym_name.'-'. Carbon::createFromFormat('d/m/Y',$license->subscribe_date)->toDateString().'.pdf');
        // return redirect()->route('gyms.show',$gym_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $gym_id , string $id)
    {
        
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->get(env('API_BASE_URL').'licenses/get/'. $id);
        
        $license = new License();
        $license->license_id = $response['_id'];
        $license->plan_id = $response['plan_id'];
        $license->subscribe_date = Carbon::parse($response['subscribe_date']);


        $plan_response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->get(env('API_BASE_URL').'plans');

        if ($plan_response->successful()) {
            $data = $plan_response->json();
            $collection = collect($data);
            $plans = collect([]);
            $pos = 0;
            foreach ($collection as $item) {
                $plan = new Plan();
                $plan->plan_id = $item['id'];
                $plan->index = $pos++;
                $plan->plan_name = $item['plan_name'];   
                $plan->price = $item['price'];
                $plan->period = $item['period'];   
                $plan->description = $item['description'];
                $plans->push($plan); 
            }
        }
        return view('licenses.edit',compact('license','plans','gym_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $gym_id, string $id)
    {
        $request->validate([
            'plan_id' => 'required',
            'subscribe_date' => 'required|date',
        ]);
        $input = $request->all();
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->put(env('API_BASE_URL')."licenses/{$id}", [
            'gym_id' => $gym_id,
            'plan_id' => $input['plan_id'],
            'subscribe_date' => Carbon::parse($input['subscribe_date']),
        ]);
        
        $data = $response->json();
        // get gym 
        $response = Http::withHeaders([
            'content-type' => 'application/json',
        ])->get(env('API_BASE_URL').'gyms/'. $gym_id);
        $gym = new Gym();
        $gym->gym_id = $response['id'];
        $gym->gym_name = $response['gym_name'];   
        $gym->owner_name = $response['owner_name'];
        $gym->phone_number = $response['phone_number'];   
        $gym->telephone = $response['telephone'];
        $gym->address = $response['address'];  
        $gym->logo = env('API_BASE_URL').'gyms/logos/' .$response['id'] ;

        // get license
        $license = new License();
        $license->plan_id = $data['plan_id'];   
        $license->subscribe_date = $data['subscribe_date'];
        $license->subscribe_end_date = $data['subscribe_end_date'];
        $license->price = $data['price'];
        $license->period = $data['period'];
        $license->product_key = $data['product_key'];
        // get plan info
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->get(env('API_BASE_URL').'plans/'.  $license->plan_id);
        $plan = new Plan();
        $plan->plan_id = $response['id'];
        $plan->plan_name = $response['plan_name'];   
        $plan->price = $response['price'];
        $plan->period = $response['period'];   
        $plan->description = $response['description'];
        // $pdf = Pdf::loadView('pdf.license',compact('gym','license','plan'))->setOption(['dpi' => 150]);
        // $pdf->setBasePath(public_path());
        // $pdf->download($gym->gym_name.'-'. Carbon::createFromFormat('d/m/Y',$license->subscribe_date)->toDateString().'.pdf');
        return view('pdf.license',compact('gym','license','plan'));
        // return redirect()->route('gyms.show',$gym_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license)
    {
        //
    }
}
