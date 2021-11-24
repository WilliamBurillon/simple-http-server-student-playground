<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/tailwind.css"/>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-900">
        <div class="container mx-auto mt-8">
            <h1 class="text-white text-2xl font-black">Etat des scores</h1>
            <ul>
                @foreach ($studentTests as $student)

                    <li class="p-6 mt-4 mb-4 shadow  text-blue-50 rounded">
                        <section >
                            <h3 class="text-xl font-bold mb-2">{{ $student->name }}</h3>
                            @if($student->tests_passed)
                                <ul class="bg-blue-800 rounded pt-4 pb-4 pl-2 pr-2">
                                    @foreach($student->tests_passed as $test)
                                        <li>✅ {{ $test }} </li>
                                    @endforeach
                                </ul>
                            @endif
                        </section>


                    </li>
                @endforeach
            </ul>
        </div>
    </body>
</html>
