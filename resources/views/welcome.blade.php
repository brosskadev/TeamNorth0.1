@extends('layouts.app')

@section('title', 'Team North')

@section('body-class', 'bg-home')

@section('content') 

<div class="image-container"> 

<div class="about-container">
                <TextAbout></TextAbout>
        </div> 

        <div class="image-container">
                <div><carousel></carousel></div>
        </div>
</div>

@endsection

@vite('resources/js/app.js')