@extends('layouts.app')

@section('title', 'Team North')

@section('body-class', 'bg-home')

@section('content')



    <div class="image-container">
        <img src="{{ asset('rosters/oldroster1.png') }}" alt="h1" />
    </div>

    <div class="image-container">
        <img src="{{ asset('rosters/Oldroster2.png') }}" alt="h1" />
    </div>

    <div class="image-container">
        <img src="{{ asset('rosters/Oldroster3.png') }}" alt="h1" />
    </div>

    <div class="image-container">
        <img src="{{ asset('rosters/ROSTER2023_3.png') }}" alt="h1" />
    </div>

    <div class="image-container" style=" margin: 0px auto 80px auto;">
        <img src="{{ asset('rosters/roster2023-2.gif') }}" alt="h1" />
    </div>

@endsection