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
        // $response = Http::withHeaders([
        //     'content-type' => 'application/json',
        // ])->get('https://uniapi-ui65lw0m.b4a.run/api/v1/licenses');
        // if ($response->successful()) {
        //     $data = $response->json();
        //     $collection = collect($data);
        //     $licenses = collect([]);
        //     foreach ($collection as $item) {
        //         $license = new License();
        //         $license->plan_id = $item['_id'];
        //         $license->gym_id = $item['gym_id'];   
        //         $license->plan_id = $item['plan_id'];
        //         $license->price = $item['price'];   
        //         $license->subscribe_date = $item['subscribe_date'];
        //         $license->subscribe_end_date = $item['subscribe_end_date'];
        //         $license->period = $item['period'];
        //         $licenses->push($license); 
        //     }
        //     return view('gyms.gyms',compact('gyms'));
        // } else {
        //     // Handle the error
        //     echo 'Request failed with status: ' . $response->status();
        // }
       
        // return $response->json();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $gym_id)
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
        ])->get('https://uniapi-ui65lw0m.b4a.run/api/v1/plans');
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
        $response = Http::post('https://uniapi-ui65lw0m.b4a.run/api/v1/licenses', [
            'gym_id' => $gym_id,
            'plan_id' => $input['plan_id'],
            'subscribe_date' => Carbon::parse($input['subscribe_date'])->format('d/m/Y'),
        ]);
        $data = $response->json();
        // get gym 
        $response = Http::withHeaders([
            'content-type' => 'application/json',
        ])->get('https://uniapi-ui65lw0m.b4a.run/api/v1/gyms/'. $gym_id);
        $gym = new Gym();
        $gym->gym_id = $response['id'];
        $gym->gym_name = $response['gym_name'];   
        $gym->owner_name = $response['owner_name'];
        $gym->phone_number = $response['phone_number'];   
        $gym->telephone = $response['telephone'];
        $gym->address = $response['address'];  
        $gym->logo = 'https://uniapi-ui65lw0m.b4a.run/api/v1/gyms/logos/' .$response['id'] ;

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
        ])->get('https://uniapi-ui65lw0m.b4a.run/api/v1/plans/'.  $license->plan_id);
        $plan = new Plan();
        $plan->plan_id = $response['id'];
        $plan->plan_name = $response['plan_name'];   
        $plan->price = $response['price'];
        $plan->period = $response['period'];   
        $plan->description = $response['description'];
        $pdf = Pdf::loadView('pdf.license',compact('gym','license','plan'))->setOption(['dpi' => 150]);
        $pdf->setBasePath(public_path());
        return $pdf->download($gym->gym_name.'-'. Carbon::parse($license->subscribe_date)->format('d-m-Y').'.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $response = Http::withHeaders([
        //     'content-type' => 'application/json',
        // ])->get('https://uniapi-ui65lw0m.b4a.run/api/v1/licenses/get/'. $id);
        // $license = new License();
        // $license->license_id = $item['_id'];
        // $license->gym_id = $item['gym_id'];   
        // $license->plan_id = $item['plan_id'];
        // $license->price = $item['price'];   
        // $license->subscribe_date = $item['subscribe_date'];
        // $license->subscribe_end_date = $item['subscribe_end_date'];
        // $license->period = $item['period'];
        
        
        

        // return view('gyms.gym',compact('gym'));
        // return $gym;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $gym_id , string $id)
    {
        
        $response = Http::withHeaders([
            'content-type' => 'application/json',
        ])->get('https://uniapi-ui65lw0m.b4a.run/api/v1/licenses/get/'. $id);
        
        $license = new License();
        $license->license_id = $response['_id'];
        $license->plan_id = $response['plan_id'];
        $license->subscribe_date = Carbon::parse($response['subscribe_date'])->format('Y-m-d');


        $plan_response = Http::withHeaders([
            'content-type' => 'application/json',
        ])->get('https://uniapi-ui65lw0m.b4a.run/api/v1/plans');

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
        $response = Http::put("https://uniapi-ui65lw0m.b4a.run/api/v1/licenses/{$id}", [
            'gym_id' => $gym_id,
            'plan_id' => $input['plan_id'],
            'subscribe_date' => Carbon::parse($input['subscribe_date'])->format('d/m/Y'),
        ]);
        dd($response);
        return $response->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license)
    {
        //
    }
}
