@extends('layouts.user_type.auth')

@section('content')
    <livewire:event-form :eventService="$eventService" />
@endsection
