<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>


    </head>
    <body style="height:100vh;background-color:#E9F2FF; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow:hidden">
        <div style="display: flex; justify-content:center; align-items: center; height: 100vh; ">
            <img src="{{asset('apple-touch-icon-114x114.png')}}"  alt="oxygen"/>
        {{-- <h1>Hello, Oxyen!</p> --}}
        </div>
    </body>
</html>
