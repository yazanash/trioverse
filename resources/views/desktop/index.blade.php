
@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header d-flex flex-row justify-content-between"><h3>{{ __('Dashboard') }}</h3>  
                <a class="btn btn-primary" href="{{route('updates.create')}}" role="button">Add Update</a>
                <a class="btn btn-primary" href="{{route('upload.form')}}" role="button">Upload version</a>
            </div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif
                      
                 
                  
                  <div class="accordion" id="accordionExample">
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($updates as $update)
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{$index}}" aria-expanded="true" aria-controls="{{$index}}">
                         <h4> {{$update->platform}}:{{$update->version}} </h4>
                        </button>
                      </h2>
                      <div id="{{$index}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body d-flex flex-direction-row justify-content-between align-items-center">
                          <div>
                            <p class="h5">file : {{$update->url}}</small>
                            <p class="text-muted h6"> {{$update->description}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    @php
                        $index++;
                    @endphp
                    @endforeach
                  
                  </div>
                  
                      
              </div>
          </div>
      </div>
  </div>
</div>


@endsection
