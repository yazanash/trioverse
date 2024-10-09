@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between"><h3>{{ __('Dashboard') }}</h3>  <a class="btn btn-primary" href="{{route('licenses.create',$gym->gym_id)}}" role="button">Add License</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                   <div class="card mb-3" >
                    <div class="row g-0 align-items-center">
                        <div class="col-md-2">
                            <img src="{{$gym->logo}}" width="200" height="200" class="img-thumbnail rounded" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"> {{$gym->gym_name}}</h5>
                                <p class="card-text">
                                    {{$gym->owner_name}}
                                </p>
                                <p class="card-text">
                                    {{$gym->address}}<br>
                                    <small class="text-muted"
                                        >{{$gym->phone_number}} - {{$gym->telephone}}</small
                                    >
                                </p>
                                @role(['admin','supervisor'])
                                <a href="{{route('gyms.edit',$gym->gym_id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{route('gyms.image.create',$gym->gym_id)}}" class="btn btn-primary">Add image</a>
                                @endrole
                            </div>
                        </div>
                    </div>
                   </div>
                   <div class="card">
                    <div class="card-header">Licenses</div>
                    <ul class="list-group list-group-flush">
                        @if ($licenses->Count()>0)
                            @foreach ($licenses as $license )
                            <li class="list-group-item d-flex flex-direction-row justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"> Plan : {{$license->plan_name}} - Price: {{$license->price}}</h5>
                                    </div>
                                    <p class="mb-1">{{$license->subscribe_date}} - {{$license->subscribe_end_date}}</p>
                                </div>
                               
                                @role(['admin','supervisor'])
                                <a href="{{route('licenses.edit',[$gym->gym_id,$license->license_id])}}" class="btn btn-primary">Edit</a>
                                @endrole
                            </li>
                            @endforeach
                        @else
                        <h5 class="text-muted m-2">No Licenses Yet</h5>
                        @endif
                       

                    </ul>
                   </div>
                   
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection