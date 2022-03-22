<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-100">
    <nav class="p-6 bg-white flex justify-between">
        <ul class="flex items-center ">
            <li>
                <a href="" class="p-3">Home</a>
            </li>
            <li>
                <a href="" class="p-3">example</a>
            </li>
            <li>
                <a href="" class="p-3">example2</a>
            </li>
        </ul>

        <ul class="flex items-center ">
            <li>
                <a href="" class="p-3">Lai Man Wai</a>
            </li>
            <li>
                <a href="" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3">Register</a>
            </li>
            <li>
                <a href="" class="p-3">Logout</a>
            </li>
        </ul>
    </nav>

    <section class="pt-7">
        @yield('content')
    </section>
    
    {{-- <h1>let's kill this love</h1> --}}
    
</body>

</html>