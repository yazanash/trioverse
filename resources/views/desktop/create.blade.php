@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Add New Update</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <main>
        <div class="row g-5">
          <div class="col-md-9 col-lg-10">
            <form method="POST" action="{{ route('updates.store') }}" class="needs-validation" novalidate="">
             @csrf
                <div class="row g-3">
                <div class="col-sm-6">
                  <label for="version" class="form-label">Version:</label>
                  <input type="text" class="form-control @error('version') is-invalid @enderror" name="version" id="version" placeholder="Enter version Number"  required>
                    @error('version')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
               
                <div class="col-sm-6">
                  <label for="url" class="form-label">URL:</label>
                  <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="e.g. https://trio-verse.com/download/updatefilename"  required>
                  @error('url')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
    
                <div class="col-12">
                  <label for="description" class="form-label">Description:</label>
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
                  <label for="platform" class="form-label">Platform</label>
                  <div class="input-group mb-3">
                    <select class="form-select @error('platform') is-invalid @enderror" id="platform" name="platform" aria-label="Default select example">
                      <option selected>Select</option>
                      <option value="mobile">mobile</option>
                      <option value="desktop">desktop</option>
                    </select>
                    @error('platform')
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

@endsection