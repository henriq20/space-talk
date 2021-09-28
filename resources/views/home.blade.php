@extends('layouts.main')

@section('title', 'Home - SpaceTalk')

@section('content')
    @include('inc.navbar')
    @auth
        <h4>{{ Auth::user()->username }}</h4>
    @endauth
@endsection