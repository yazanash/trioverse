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
                            <form id="upload-form" action="{{route('gyms.image.store',$gym_id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <img id="preview" src="#" alt="Image Preview" width="200" height="200" style="display: none;">
                                </div>
                                <div class="form-group my-2">
                                    <label for="image">Choose Image</label>
                                    <input type="file" name="image" id="image" class="form-control" onchange="previewImage(event)">
                                </div>
                               
                                <button type="submit" class="btn btn-primary">Upload Image</button>
                            </form>
                          </div>
                        </div>
                      </main>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script> --}}
{{-- <script>
    const imageInput = document.getElementById('image-input');
    const imagePreview = document.getElementById('image-preview');
    let cropper;

    imageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = (e) => {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';

            cropper = new Cropper(imagePreview, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
            });
        };

        reader.readAsDataURL(file);
    });

    document.getElementById('upload-form').addEventListener('submit', (event) => {
        event.preventDefault();

        cropper.getCroppedCanvas().toBlob((blob) => {
            const formData = new FormData();
            formData.append('image', blob, 'cropped.jpg');

            fetch("{{route('gyms.image.store',$gym_id)}}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            }).then(response => response.json()).then(data => {
                console.log(data);
            });
        });
    });
</script> --}}

<script>

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection