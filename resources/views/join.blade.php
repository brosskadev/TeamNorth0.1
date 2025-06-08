@extends('layouts.app')

@section('title', 'Team North')

@section('body-class', 'bg-home')

@section('content')

        <div class="image-container">
        <video id="popanov" width="1200" height="800" controls>
        <source src="{{ asset('videos/FOBPOPANOV2.mp4') }}" type="video/mp4">
        Ваш браузер не поддерживает видео тег.
        </video>

        <script>
        const video = document.getElementById('popanov');

        const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
        if (entry.isIntersecting) {video.play();} else {video.pause();}});}, { threshold: 0.5 });
        observer.observe(video);
        </script>
        </div>

        <div class="d-flex justify-content-center align-items-center" style="height: 15vh;">
    <a href="https://discord.gg/teamnorth"
       class="btn btn-primary text-center fw-bold"
       style="width: 60%; height: 100px; font-size: 2rem; display: flex; align-items: center; justify-content: center;">
        Вступить
    </a>
</div>

@endsection