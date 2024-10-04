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
                            <form method="POST" action="{{route('plans.store')}}" class="needs-validation" novalidate="">
                             @csrf
                                <div class="row g-3">
                                <div class="col-sm-6">
                                  <label for="plan_name" class="form-label">Plan Name</label>
                                  <input type="text" class="form-control @error('plan_name') is-invalid @enderror" name="plan_name" id="plan_name" placeholder="Enter Plan Name"  required>
                                    @error('plan_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                    
                                <div class="col-sm-6">
                                  <label for="price" class="form-label">Price</label>
                                  <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="e.g. 300,000"  required>
                                  @error('price')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                </div>
                    
                                <div class="col-12">
                                  <label for="description" class="form-label">Address</label>
                                  <div class="input-group has-validation">
                                    <textarea rows="3" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="e.g. Description about the plan features" required></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                </div>
                    
                                <div class="col-sm-6">
                                  <label for="period" class="form-label">Period</label>
                                  <div class="input-group mb-3">
                                    <select class="form-select @error('period') is-invalid @enderror" id="period" name="period" aria-label="Default select example">
                                      <option value="-1" selected>Select</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="6">6</option>
                                      <option value="12">12</option>
                                    </select>
                                      <span class="input-group-text" id="inputGroup-sizing-default">Month(s)</span>
                                    @error('period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  
                                  </div>
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