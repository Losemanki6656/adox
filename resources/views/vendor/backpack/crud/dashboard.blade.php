@extends(backpack_view('blank'))

@section('after_styles')
    <style>
        .welcome-quote {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 200px);
            min-height: 200px;
        }

        .welcome-quote blockquote::before {
            display: block;
            content: "\201C";
            font-size: 89px;
            position: absolute;
            left: -15px;
            top: -20px;
            color: #7a7a7a;
        }

        .welcome-quote blockquote {
            font-family: Georgia, serif;
            font-size: 25px;
            font-style: italic;
            max-width: 100%;
            margin: 0.25em 0;
            padding: 0.25em 0 0.35em 40px;
            line-height: 1.45;
            position: relative;
            color:
                #383838;
        }

        .welcome-quote blockquote cite {
            color: #999999;
            font-size: 18px;
            display: block;
            margin-top: 10px;
        }
    </style>
@endsection

@php
    $full = \Illuminate\Foundation\Inspiring::quote();
    $quota = substr($full, 0, strpos($full, ' - '));
    $author = substr($full, strpos($full, ' - '), strlen($full) - strpos($full, ' - '));
@endphp

@section('content')
    <div class="welcome-quote">
        <blockquote>
            {{ $quota }}
            <cite>{{ $author }}</cite>
        </blockquote>
    </div>
@endsection
