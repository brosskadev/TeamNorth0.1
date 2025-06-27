@extends('layouts.app')

@section('title', 'Team North')

@section('body-class', 'bg-home')

@section('content')

Привет {{ Auth::user()->login }}

@endsection