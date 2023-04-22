<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{config('app.forum_name')}} Certificate - {{$details->name}}</title>
  <link rel="icon" href="{{asset("favicon.png")}}" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="152x152" href="{{asset("apple-touch-icon-152x152.png")}}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset("apple-touch-icon-120x120.png")}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset("apple-touch-icon-76x76.png")}}">
  <link rel="apple-touch-icon" href="{{asset("apple-touch-icon.png")}}">
  <link rel="icon" href="{{asset("apple-touch-icon.png")}}" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link as="style" rel="stylesheet preload"
  href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" type="text/css"
  crossorigin="anonymous" />
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
@php
    $description = $details->name. " fully participated in the " .config('app.forum_name'). ". Check out their certificate.";
@endphp
   <!-- Search Engine -->
   <meta name="description"
       content="{{$description}}">
   <!-- Schema.org for Google -->
   <meta itemprop="name" content="{{config('app.forum_name')}} Certificate - {{$details->name}}">
   <meta itemprop="description"
       content={{$description}}>
   <!-- Twitter -->
   <meta name="twitter:card" content="summary">
   <meta name="twitter:title" content="{{config('app.forum_name')}} Certificate - {{$details->name}}">
   <meta name="twitter:description"
       content="{{$description}}">
   <!-- Open Graph general (Facebook, Pinterest & Google+) -->
   <meta name="og:title" content="{{config('app.forum_name')}} Certificate - {{$details->name}}">
   <meta name="og:description"
       content="{{$description}}">
   <meta name="og:type" content="website">
   <meta name="author" content="@oxygenhealthconnect">
</head>
<body>

    <div id="page-container">
        <div id="page-inner">
        <div id="cert-outlet">
            <img src="{{asset('assets/img/forum_cert_temp.png')}}" alt="">
            <h1 class="name">{{strToUpper($details->name)}}</h1>
            <div id="cert-creds" class="cert-creds abs left-indent">
                <p>Date of Issue: 14 April 2023</p>
                <p>Certificate ID: {{$details->unique_code}}</p>
            </div>
        </div>


        <div id="dl">
            <button id="toPdf" class="buttonDownload">Download PDF</button>
            <button id="toPng" class="buttonDownload">Download PNG</button>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

    <script src="https://unpkg.com/dom-to-image-more@2.15.0/dist/dom-to-image-more.min.js"></script>

    <script type="text/javascript">
    let FILE_NAME = `{{config('app.forum_name')}} Certificate - {{$details->name}}`;
    var CERT_WIDTH = 842;
    var CERT_HEIGHT = 595.4;

    var widthInPT = (CERT_WIDTH / 96) * 72;
    var heightInPT = (CERT_HEIGHT / 96) * 72;

    var certPDF = new jsPDF("l", "pt", [widthInPT, heightInPT]);
    var certHTML = document.getElementById("cert-outlet");

    document.getElementById("toPng").addEventListener("click", generatePNG);
    document.getElementById("toPdf").addEventListener("click", generatePDF);

    function generatePNG() {
        const node = document.getElementById("cert-outlet");
        var scale = 1;
        domtoimage
            .toPng(node, {
                width: node.clientWidth * scale,
                height: node.clientHeight * scale,
                style: {
                    transform: "scale(" + scale + ")",
                    transformOrigin: "top left",
                },
            })
            .then(function (dataUrl) {
                const link = document.createElement("a");
                link.download = FILE_NAME + ".png";
                link.href = dataUrl;
                link.click();
            });
    }

    function generatePDF() {
        const node = document.getElementById("cert-outlet");
        var scale = 1;
        domtoimage
            .toPng(node, {
                width: node.clientWidth * scale,
                height: node.clientHeight * scale,
                style: {
                    transform: "scale(" + scale + ")",
                    transformOrigin: "top left",
                },
            })
            .then(function (dataUrl) {
                certPDF.addImage(dataUrl, "png", 0, 0, widthInPT, heightInPT);
                certPDF.save(FILE_NAME);
            });
    }

    </script>
</body>
</html>

