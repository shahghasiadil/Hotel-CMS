@extends('layouts.admin')

@section('content')

<dashboard-component
locale="{{ app()->getLocale() }}"></dashboard-component>

@endsection