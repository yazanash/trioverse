<section class="p-5 mt-5" style=" max-height: 100vh;">
    <div class="container">
     
       <section class="row py-2 mb-2">
        <header>
          <h2 class="fw-700">Overview</h2>
        </header>
            <div class="col-lg-4 col-sm-6 py-1">
                <div class="card shadow">
                    <div class="card-body p-3">
                      <div class="d-flex flex-row justify-content-between align-items-center">
                        <div class="flex-column">
                          <h4 class="card-title text-muted">Gyms</h4>
                          <h1 class="card-text">1.3k</h1>
                        </div>
                        <div style="--icon-color:#E27F6D" class="icon">
                          <i class="las la-dumbbell"></i>
                        </div>
                      </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 py-1">
              <div class="card shadow">
                <div class="card-body p-3">
                  <div class="d-flex flex-row justify-content-between align-items-center">
                    <div class="flex-column">
                      <h4 class="card-title text-muted">Licenses</h4>
                      <h1 class="card-text">8.6K</h1>
                    </div>
                    <div style="--icon-color:#2CA16A" class="icon">
                      <i class="las la-receipt"></i>
                    </div>
                  </div>
                   
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-sm-6 py-1">
              <div class="card shadow">
                <div class="card-body p-3">
                  <div class="d-flex flex-row justify-content-between align-items-center">
                    <div class="flex-column">
                      <h4 class="card-title text-muted">Users</h4>
                      <h1 class="card-text">5.9M</h1>
                    </div>
                    <div style="--icon-color:#1E78B8" class="icon">
                      <i class="las la-user-friends"></i>
                    </div>
                  </div>
                   
                </div>
            </div>
            </div>
            
        </section>
       <section class="row py-2 gap-1">
        <div   class="col justify-content-center align-items-center ">
        
          <header class="d-flex flex-row justify-content-between align-items-center">
            <h2>Gyms</h2>
            <a href="{{route('gyms.create')}}" class="btn btn-primary fs-4">Add Gym</a>
          </header>
            <div style="max-height: 100vh; overflow-y: scroll; overflow-x: hidden;" class="card mt-2 shadow p-2">
                        <ul class="list-group ">
                            @foreach ($gyms as $gym )
                            <a href="#" class="list-group-item list-group-item-action mb-1 border-0">
                                <div class="d-flex justify-content-start align-items-start">
                                    <img src="{{$gym->logo}}" height="50" width="50" class="img-thumbnail" alt="...">
                                    <div class="align-items-start px-3">
                                        <h5>{{$gym->gym_name}}</h5>
                                        <p>{{$gym->owner_name}}</p>
                                    </div>
                                </div>    
                            </a>
                            @endforeach
                      
                    </ul>
            </div>
        </div>
        
        
   </div>
   
  </section>