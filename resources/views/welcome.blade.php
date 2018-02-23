@extends('layouts.master')

@section('content')
    <h1>Welcome to  {{ config('app.name') }}</h1>
@endsection

@section('scripts')
    <script>
        errorNotification("{{ session('message') }}")
    </script>
@endsection
