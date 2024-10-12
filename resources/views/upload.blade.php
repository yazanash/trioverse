@extends('layouts.app')

@section('content')
<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Upload File</h5>
                </div>
                <div class="card-body">
                    <div id="upload-container" class="text-center">
                        <button id="browseFile" class="btn btn-primary">Browse File</button>
                    </div>
                    <div class="progress mt-3" style="display: none; height: 25px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%; height: 100%;"></div>
                    </div>
                </div>
                <div class="card-footer p-4" style="display: none;">
                    <img id="imagePreview" src="" style="width: 100%; height: auto; display: none;" alt="img"/>
                    <video id="videoPreview" src="" controls style="width: 100%; height: auto; display: none;"></video>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
    var browseFile = $('#browseFile');
    var resumable = new Resumable({
        target: '/upload',
        query: { _token: '{{ csrf_token() }}' },
        fileType: ['exe'],
        chunkSize: 1 * 1024 * 1024,
        simultaneousUploads: 3,
        testChunks: false,
        throttleProgressCallbacks: 1,
    });

    resumable.assignBrowse(browseFile[0]);

    resumable.on('fileAdded', function (file) {
        $('.progress').show();
        resumable.upload();
    });

    resumable.on('fileProgress', function (file) {
        var progress = Math.floor(file.progress() * 100);
        $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
    });

    resumable.on('fileSuccess', function (file, response) {
        alert('File uploaded successfully.');
    });

    resumable.on('fileError', function (file, response) {
        alert('File upload failed.');
    });
});
</script>
@endsection