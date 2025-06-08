@extends('layouts.app')

@section('title', 'Team North')

@section('body-class', 'bg-home')

@section('content')

        <div class="stroka-container">
                <div id="app">
                <stroka></stroka>
                </div>
        </div>

        <div class="image-container">

        <img src="{{ asset('rosters/roster.png') }}" alt="2814a12fe3dfadb5" />
        </div>

        <div class="image-container" style=" margin: 0px auto 80px auto;">
        <img src="{{ asset('images/sostav.png') }}" alt="sostav" />
        </div>

        <div id="app">
        <fade-box></fade-box>
        </div>

@endsection

@vite('resources/js/app.js')