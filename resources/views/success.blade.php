@extends('layoutFront')
@section('head')
    <link rel="stylesheet" href="venue.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        div.out{
            height: 100%;
            display: flex;
            font-family: system-ui, sans-serif;
            text-align: center;
            margin-left: 700px;
        }
        div.one {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        div.two {
            padding-top: 20px;
            margin-bottom: 25px;
        }
        div.one h1 {
            font-size: 30pt;
            font-weight: bold;
            color: #f29207;
            margin-top: 25px;
            margin-bottom: 20px;
        }
        div.one h4 {
            font-size: 16pt;
        }
        div.one img {
            width: 35%;
            margin: 0px auto;
            display: flex;
        }
        div.one a{
            text-decoration: none;
            color: initial;
        }
        div.one a.alt {
            margin-right: 10px;
        }
        div.one a.def {
            margin-left: 10px;
        }
        div.one span {
            font-family: inherit;
            font-size: 13.5pt;
            border-radius: 15px;
            padding: 9px 10px;
            cursor: pointer;
            font-weight: 500;
        }
        div.one a.alt span {
            background: #fce9a4;
        }
        div.one a.def span {
            background: #ffbc3b;
        }
    </style>
@endsection

@section('body')

<div class="out">
    <div class="one">
        <h1> Registered Successful</h1>
        <img src='/img/success_payment.png' alt='success'>
        <div class="two">
            <a class="alt" href='/homepage'>
                <span>Back to Home</span>
            </a>
        </div>
    </div>
</div>
@endsection