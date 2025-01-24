@extends('layouts.vertical', ['title' => 'Google Maps', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
@include('layouts.shared/page-title',['page_title' => 'Google Maps','sub_title' => 'Maps'])

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title mb-0">Basic Google Map</h4>
            </div>
            <div class="card-body">
                <div id="gmaps-basic" class="gmaps"></div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title mb-0">Markers Google Map</h4>
            </div>
            <div class="card-body">
                <div id="gmaps-markers" class="gmaps"></div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row-->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title mb-0">Street View Panoramas Google Map</h4>
            </div>
            <div class="card-body">
                <div id="panorama" class="gmaps"></div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title mb-0">Google Map Types</h4>
            </div>
            <div class="card-body">
                <div id="gmaps-types" class="gmaps"></div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row-->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title mb-0">Ultra Light with Labels</h4>
            </div>
            <div class="card-body">
                <div id="ultra-light" class="gmaps"></div>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <!-- end col-->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title mb-0">Dark</h4>
            </div>
            <div class="card-body">
                <div id="dark" class="gmaps"></div>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <!-- end col-->
</div>
<!-- end row-->
@endsection

@section('script')
    <!-- Google Maps API -->
    <script src="https://maps.google.com/maps/api/js"></script>
    @vite(['resources/js/pages/google-maps.init.js'])
@endsection
