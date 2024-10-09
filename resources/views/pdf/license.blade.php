<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Cairo" rel="stylesheet">
    <style>html{font-size: 15px}
        .card{
            background: #ffffff
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.4/purify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    {{-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all"> --}}
</head>
<body  style="font-family:Arial">
    <div id="app">
        <main class="py-4">
           <section class="container  bg-light " style="max-height: 100vh" id="content">
            <div class="card mb-3 border-0 " style="max-width: 540px;" >
                <div class="row g-0 align-items-center">
                    <div class="col-md-2">
                        <img 
                            src="{{asset('images/logo.png')}}" width="200" height="200"
                            class="img-fluid rounded-start"
                            alt="Card title"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="card-title fw-bold">Uniceps License</h1>
                            <p class="card-text text-muted fs-5">
                                License DATE : 01/10/2024
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-4">
                        <div class="card border-0">
                            <div class="card-body">
                                <h2 class="card-title">Trioverse</h2>
                                <p class="card-text">
                                    +963 994916917 <br>
                                    Syria , swaida <br>
                                    support@trio-verse.com
                                </p>

                            </div>
                        </div>
                        
                    </div>
                    <div  class="col-4" >
                        <div class="card border-0">
                            <div class="card-body">
                                <h2 class="card-title">{{$gym->gym_name}}</h2>
                                <p class="card-text">{{$gym->owner_name}} <br> {{$gym->phone_number}} <br> {{$gym->address}}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <hr>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Plan Name</th>
                    <th scope="col">Plan Period (months)</th>
                    <th scope="col">Price (Syrian Pound)</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col-4">Product Key</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>{{$plan->plan_name}}</td>
                    <td>{{$license->period}}</td>
                    <td>{{$license->price}}</td>
                    <td>{{$license->subscribe_date}}</td>
                    <td>{{$license->subscribe_end_date}}</td>
                    <td>{{$license->product_key}}</td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                
                <div class="col">
                    <div class="card mb-3  border-0" style="max-width: 540px;" >
                        <div class="row g-0 align-items-center">
                            <div class="col-md-1">
                                <img
                                    src="{{asset('images/trio-logo.png')}}"
                                    class="img-fluid rounded-start"
                                    alt="Card title"
                                />
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title">Trioverse</h5>
                                    <p class="card-text">
                                        For software development and business solutions <br>
                                        <small class="text-muted"
                                            >All rights reseved &copy;</small
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card border-0 text-end">
                        <div class="card-body">
                            <h4 class="card-title">Total</h4>
                            <h3 class="card-text">{{$license->price}} S.P</h3>
                        </div>
                      </div>
                </div>
              </div>
              
           </section>
        </main>
    </div>
    <div class="container">
        <button class="btn btn-primary" onclick="generatePDF()">Download PDF</button>
        <a href="{{route('gyms.index')}}" class="btn btn-danger">Back to home</a>
    </div>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> --}}


    <script>
        function printDiv() {
            const content = document.getElementById('content');
            const cleanContent = DOMPurify.sanitize(content.innerHTML);
            const opt = {
                margin:       1,
                filename:     'document.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(cleanContent).set(opt).save();
        }
        async function generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'landscape',
                unit: 'mm',
                format: 'a4'
            });
            const content = document.getElementById('content').innerHTML;
            const cleanContent = DOMPurify.sanitize(content);
            await html2canvas(document.getElementById('content'), {
                scale: 2
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 210;
                const pageHeight = 297;
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                doc.save('document.pdf');
            });
        }
    </script>
</body>
</html>