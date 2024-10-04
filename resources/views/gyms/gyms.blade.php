
  @extends('layouts.app')

  @section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between"><h3>{{ __('Dashboard') }}</h3>  <a class="btn btn-primary" href="{{route('gyms.create')}}" role="button">Add Gym</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                   
                    
                    
                    

                        <div class="list-group">
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
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>
 
  
  @endsection
