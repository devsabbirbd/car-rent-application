@extends('layout.app')
@section('content')
    @include('components.header.header')

    @if(isset($car) && $car['availability'] == 1)
    @include('components.rent.create-rent')
    @endif
    
    @include('components.section.car-details')
    @include('components.footer.footer')
@endsection