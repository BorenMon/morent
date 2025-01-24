@extends('layouts.vertical', ['title' => 'Bootstrap Icons', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['sub_title' => 'Icons', 'page_title' => 'Bootstrap Icons'])
   
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Icons</h5>
                    <p class="text-muted">Use class
                        <code>&lt;i class=&quot;bi bi-123&quot;&gt;&lt;/i&gt;</code>
                    </p>
                    <div class="row icons-list-demo" id="bootstrap-icons"></div>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('script')
    <!-- MDI Icons Demo js -->
    @vite(['resources/js/pages/icons-bootstrap.init.js'])
@endsection
