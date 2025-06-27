@extends('layouts.app')

@section('title', 'Team North')

@section('body-class', 'bg-home')

@section('content') 

<div class="section-wrapper" style="display: flex; flex-direction: row; justify-content: space-between;"> 
        <div class="welcome-container">
                <leftbuttonswelcome></leftbuttonswelcome>
        </div>
        <div class="welcome-container">
                <centerbuttonswelcome></centerbuttonswelcome>
                <textabout></textabout>
        </div>
        <div class="welcome-container">
                <rightbuttonswelcome></rightbuttonswelcome>
        </div>
</div>

@endsection

@vite('resources/js/app.js')