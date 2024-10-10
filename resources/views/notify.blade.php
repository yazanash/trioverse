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
                            <form method="POST" action="{{route('notify.store')}}" class="needs-validation" novalidate="">
                             @csrf
                                <div class="row g-3">
                                <div class="col-sm-6">
                                  <label for="title" class="form-label">Title</label>
                                  <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter Notification title"  required>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                    
                               
                    
                                <div class="col-12">
                                  <label for="body" class="form-label">Body</label>
                                  <div class="input-group has-validation">
                                    <textarea rows="3" class="form-control @error('body') is-invalid @enderror" id="body" name="body" placeholder="e.g. Notifications message" required></textarea>
                                    @error('body')
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