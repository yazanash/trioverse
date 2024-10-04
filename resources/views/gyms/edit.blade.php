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
                            <form method="POST" action="{{route('gyms.update',$gym->gym_id)}}" class="needs-validation" novalidate="">
                             @csrf
                                <div class="row g-3">
                                <div class="col-sm-6">
                                  <label for="gym_name" class="form-label">Gym Name</label>
                                  <input type="text" class="form-control @error('gym_name') is-invalid @enderror" name="gym_name" id="gym_name" value="{{$gym->gym_name}}"  required>
                                    @error('gym_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                    
                                <div class="col-sm-6">
                                  <label for="owner_name" class="form-label">Owner Name</label>
                                  <input type="text" class="form-control @error('owner_name') is-invalid @enderror" id="owner_name" name="owner_name" value="{{$gym->owner_name}}" required>
                                  @error('owner_name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                </div>
                    
                                <div class="col-12">
                                  <label for="address" class="form-label">Address</label>
                                  <div class="input-group has-validation">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"  value="{{$gym->address}}" required>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                </div>
                    
                                <div class="col-sm-6">
                                  <label for="phone_number" class="form-label">Phone Number</label>
                                  <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number"  value="{{$gym->phone_number}}" required>
                                  @error('phone_number')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                </div>
                    
                                <div class="col-sm-6">
                                  <label for="telephone" class="form-label">Telephone Number</label>
                                  <input type="tel" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{$gym->telephone}}" required>
                                  @error('telephone')
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