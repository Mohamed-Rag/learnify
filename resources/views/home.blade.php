@extends('layouts.main')

@section('content')
<div class="content">
    <div class="text-content">
        <h1>Unlock Your Potential with <span style="color: #860000;">Learnify</span></h1>
        <p>Join us for an engaging and comprehensive learning experience designed to help you. Whether you're a beginner or looking to deepen your knowledge, this website provides expert guidance, interactive lessons, and hands-on practice to ensure success.</p>
        <a href="{{ url('courses') }}" class="discover-btn"><b>Discover more</b></a>
    </div>
    <div class="cat">
        <img src="{{ asset('images/cat.png') }}" alt="cat">
    </div>
</div>
@endsection
