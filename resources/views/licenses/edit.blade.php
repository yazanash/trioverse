@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header d-flex flex-row justify-content-between"><h3>{{ __('Dashboard') }}</h3>  </div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif
                  <main>
                      <div class="row g-5">
                        <div class="col-md-9 col-lg-10">
                          <form method="POST" action="{{route('licenses.update',[$gym_id,$license->license_id])}}" class="needs-validation" novalidate="">
                           @csrf
                              <div class="row g-3">
                              <div class="col-sm-6">
                                <label for="plan_id" class="form-label">Plan :</label>
                                <div class="input-group mb-3">
                                  <select class="form-select @error('plan_id') is-invalid @enderror" id="plan_id" name="plan_id" aria-label="Default select example">
                                    <option value="" selected>Select</option>
                                    @foreach ($plans as $plan)
                                    <option @if ($plan->plan_id === $license->plan_id)  selected @endif value="{{$plan->plan_id}}">{{$plan->plan_name}} - {{$plan->price}}</option>
                                    @endforeach
                                  </select>
                                  @error('plan_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                
                                </div>
                              </div>
                  
                              <div class="col-sm-6">
                                <label for="subscribe_date" class="form-label">subscribe date</label>
                                <input type="date" class="form-control @error('subscribe_date') is-invalid @enderror" id="subscribe_date" value="{{$license->subscribe_date}}" name="subscribe_date"  required>
                                @error('subscribe_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>
                            <hr class="my-4">
                            <button class="float-end btn btn-success" type="submit">Save</button>
                          </form>
                        </div>
                      </div>
                    </main>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection