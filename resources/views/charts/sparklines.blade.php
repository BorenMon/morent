@extends('layouts.vertical', ['title' => 'Sparkline Charts', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['sub_title' => 'Charts', 'page_title' => 'Sparkline'])

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Line Charts</h4>
                    <div class="mt-4">
                        <div id="sparkline1" data-colors="#3bc0c3,#4489e4"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Bar Chart</h4>
                    <div class="mt-4">
                        <div id="sparkline2" data-colors="#3bc0c3" class="text-center"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Pie Chart</h4>
                    <div class="mt-4">
                        <div id="sparkline3" data-colors="#3bc0c3,#4489e4,#d03f3f,#716cb0"
                            class="text-center"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Custom Line Chart</h4>
                    <div class="mt-4">
                        <div id="sparkline4" data-colors="#3bc0c3,#716cb0" class="text-center"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Mouse Speed Chart</h4>
                    <div class="mt-4">
                        <div id="sparkline5" data-colors="#716cb0" class="text-center"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Composite bar Chart</h4>
                    <div class="text-center mt-4">
                        <div id="sparkline6" data-colors="#f2f2f7,#3bc0c3" class="text-center"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Discrete Chart</h4>
                    <div class="text-center mt-4">
                        <div id="sparkline7" data-colors="#33b0e0" class="text-center"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Bullet Chart</h4>
                    <div class="text-center mt-4" style="min-height: 164px;">
                        <div id="sparkline8" data-colors="#f24f7c,#4489e4" class="text-center"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Box Plot Chart</h4>
                    <div class="text-center mt-4" style="min-height: 164px;">
                        <div id="sparkline9" data-colors="#3bc0c3,#1a2942,#d1d7d973" class="text-center"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tristate Charts</h4>
                    <div class="text-center mt-4" style="min-height: 164px;">
                        <div id="sparkline10" data-colors="#d1d7d973,#1a2942,#3bc0c3" class="text-center">
                        </div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
@endsection

@section('script')
    @vite(['resources/js/pages/sparkline.init.js'])
@endsection
