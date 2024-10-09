
  @extends('layouts.app')

  @section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between"><h3>{{ __('Dashboard') }}</h3>  <a class="btn btn-primary" href="{{route('plans.create')}}" role="button">Add Plan</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                   
                    
                    <div class="accordion" id="accordionExample">
                      @foreach ($plans as $plan)
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{$plan->index}}" aria-expanded="true" aria-controls="{{$plan->index}}">
                           <h4> {{$plan->plan_name}} </h4>
                          </button>
                        </h2>
                        <div id="{{$plan->index}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                          <div class="accordion-body d-flex flex-direction-row justify-content-between align-items-center">
                            <div>
                              <h4><strong> {{$plan->price}}</strong></h3> 
                              <p class="h5">Period : {{$plan->period}}</small>
                              <p class="text-muted h6"> {{$plan->description}}</p>
                            </div>
                            <a href="{{route('plans.edit',$plan->plan_id)}}" class="btn btn-primary">Edit</a>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    
                    </div>
                    

                        {{-- <div class="list-group">
                          @foreach ($gyms as $gym )
                          <a
                            href="{{route('gyms.show',$gym->gym_id)}}"
                            class="list-group-item list-group-item-action mb-2 rounded bg-white flex-column align-items-start"
                            aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">
                                <img src="{{$gym->logo}}" height="50" width="50" class="img-thumbnail rounded-circle" alt="...">
                                {{$gym->gym_name}}</h5>
                              <small class="text-muted">{{$gym->phone_number}} <br> {{$gym->telephone}}</small>
                            </div>
                            <p class="mb-1">{{$gym->owner_name}}</p>
                            <small class="text-muted">{{$gym->address}}</small>
                          </a>
                          @endforeach
                        </div> --}}
                        
                </div>
            </div>
        </div>
    </div>
</div>
 
  
  @endsection
