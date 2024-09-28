@extends('layout.app')

@section('head')
    <link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <style>
        .btn-outline-danger:hover {
            color: #fff !important;
            background-color: #ea0606 !important;
            border-color: #ea0606 !important;
            box-shadow: 0 3px 5px -1px rgba(0, 0, 0, 0.09), 0 2px 3px -1px rgba(0, 0, 0, 0.07) !important;
            transform: scale(1);
            opacity: 1 !important;
        }
    </style>
@endSection

@section('content')
    @include('components.header.header')
    @include('components.rent.cancel-rent')
    @include('components.section.rental-history-list')
    @include('components.footer.footer')
@endSection