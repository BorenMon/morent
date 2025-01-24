@extends('layouts.vertical', ['title' => 'Embed Video', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['sub_title' => 'Base UI', 'page_title' => 'Embed Video'])

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Responsive embed video 21:9</h4>
                    <p class="text-muted mb-0">Use class <code>.ratio-21x9</code></p>
                </div>
                <div class="card-body">
                    <!-- 21:9 aspect ratio -->
                    <div class="ratio ratio-21x9">
                        <iframe
                            src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"></iframe>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Responsive embed video 1:1</h4>
                    <p class="text-muted mb-0">Use class <code>.ratio-1x1</code></p>
                </div>
                <div class="card-body">
                    <!-- 1:1 aspect ratio -->
                    <div class="ratio ratio-1x1">
                        <iframe src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"></iframe>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Responsive embed video 16:9</h4>
                    <p class="text-muted mb-0">Use class <code>.ratio-16x9</code></p>
                </div>
                <div class="card-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"></iframe>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Responsive embed video 4:3</h4>
                    <p class="text-muted mb-0">Use class <code>.ratio-4x3</code></p>
                </div>
                <div class="card-body">
                    <!-- 4:3 aspect ratio -->
                    <div class="ratio ratio-4x3">
                        <iframe src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"></iframe>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
