@extends('layouts.vertical', ['title' => 'Vector Maps', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    @vite(['node_modules/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css'])
@endsection

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Vector Maps', 'sub_title' => 'Maps'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">World Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="world-map-markers" style="height: 360px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">USA Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="usa-vectormap" style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">India Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="india-vectormap"  style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">Australia Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="australia-vectormap" style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">Chicago Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="chicago-vectormap"  style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">UK Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="uk-vectormap" style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">Canada Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="canada-vectormap"  style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">Europe Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="europe-vectormap" style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">France Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="france-vectormap"  style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">Spain Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="spain-vectormap" style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">Spain Vector Map</h4>
                </div>
                <div class="card-body">
                    <div id="spain2-vectormap"  style="height: 300px"></div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
@endsection

@section('script')
    <!-- Vector Maps Demo js -->
    @vite(['resources/js/pages/vector-maps.init.js'])
@endsection
