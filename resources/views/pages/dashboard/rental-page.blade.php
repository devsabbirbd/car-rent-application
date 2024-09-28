@extends('layout.sidenav-layout')
@section('head')
    <style>
        .editBtn {
            border: none !important;
        }
        .editBtn:hover {
            opacity: 1 !important;
        }
    </style>
@endSection
@section('content')
    @include('components.rent.rent-list')
    @include('components.rent.rent-delete')
@endSection


