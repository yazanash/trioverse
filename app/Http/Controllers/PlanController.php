<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
            return view('Plan.plans',compact('plans'));
        } else {
            // Handle the error
        }
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'plan_name' => 'required',
            'price' => 'required',
            'period' => 'required|gt:0',
            'description' => 'required',
        ]);
     
        $input = $request->all();
        $response = Http::withHeaders([
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->post(env('API_BASE_URL').'plans', [
            'plan_name' => $input['plan_name'],
            'price' => $input['price'],
            'period' => $input['period'],
            'description' => $input['description']
        ]);
        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        // return $gym;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->get(env('API_BASE_URL').'plans/'. $id);
        $plan = new Plan();
        $plan->plan_id = $response['id'];
        $plan->plan_name = $response['plan_name'];   
        $plan->price = $response['price'];
        $plan->period = $response['period'];   
        $plan->description = $response['description'];
        return view('Plan.edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'plan_name' => 'required',
            'price' => 'required',
            'period' => 'required',
            'description' => 'required',
        ]);
        $input = $request->all();
        $response = Http::WithHeaders([
            'X-API-KEY' => env('FLASK_API_KEY'),
        ])->put(env('API_BASE_URL')."plans/{$id}", [
            'plan_name' => $input['plan_name'],
            'price' => $input['price'],
            'period' => $input['period'],
            'description' => $input['description']
        ]);
        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
