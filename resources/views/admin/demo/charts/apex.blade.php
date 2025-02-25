@extends('admin.layouts.horizontal', ['title' => 'Apex Charts', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('admin.layouts.shared/page-title', ['sub_title' => 'Charts', 'page_title' => 'Apex Charts'])

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Basic Area Chart</h4>
                    <div dir="ltr">
                        <div id="basic-area" class="apex-charts" data-colors="#3bc0c3"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Spline Area</h4>
                    <div dir="ltr">
                        <div id="spline-area" class="apex-charts" data-colors="#3bc0c3,#1a2942"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Basic Bar Chart</h4>
                    <div dir="ltr">
                        <div id="basic-bar" class="apex-charts" data-colors="#4489e4"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Grouped Bar Chart</h4>
                    <div dir="ltr">
                        <div id="grouped-bar" class="apex-charts" data-colors="#33b0e0,#f24f7c"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Basic Boxplot</h4>
                    <div dir="ltr">
                        <div id="basic-boxplot" class="apex-charts" data-colors="#3bc0c3,#47ad77"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Scatter Boxplot </h4>
                    <div dir="ltr">
                        <div id="scatter-boxplot" class="apex-charts" data-colors="#fa5c7c,#6c757d"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Simple Bubble Chart</h4>
                    <div dir="ltr">
                        <div id="simple-bubble" class="apex-charts" data-colors="#3bc0c3,#edc755,#fa5c7c"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">3D Bubble Chart</h4>
                    <div dir="ltr">
                        <div id="second-bubble" class="apex-charts" data-colors="#3bc0c3,#47ad77,#fa5c7c,#39afd1"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Simple Candlestick Chart</h4>
                    <div dir="ltr">
                        <div id="simple-candlestick" class="apex-charts" data-colors="#47ad77,#fa5c7c"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Combo Candlestick Chart</h4>
                    <div dir="ltr">
                        <div id="combo-candlestick" class="apex-charts" data-colors="#47ad77,#fa5c7c"></div>
                        <div id="combo-bar-candlestick" class="apex-charts" data-colors="#3bc0c3,#edc755"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Basic Column Chart</h4>
                    <div dir="ltr">
                        <div id="basic-column" class="apex-charts" data-colors="#3bc0c3,#4489e4,#33b0e0"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Column Chart with Datalabels</h4>
                    <div dir="ltr">
                        <div id="datalabels-column" class="apex-charts" data-colors="#3bc0c3"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Simple line chart</h4>
                    <div dir="ltr">
                        <div id="line-chart" class="apex-charts" data-colors="#edc755"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Line with Data Labels</h4>
                    <div dir="ltr">
                        <div id="line-chart-datalabel" class="apex-charts" data-colors="#d03f3f,#3bc0c3"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Line & Column Chart</h4>
                    <div dir="ltr">
                        <div id="line-column-mixed" class="apex-charts" data-colors="#4489e4,#3bc0c3"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Multiple Y-Axis Chart</h4>
                    <div dir="ltr">
                        <div id="multiple-yaxis-mixed" class="apex-charts" data-colors="#3bc0c3,#39afd1,#fa5c7c"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Simple Pie Chart</h4>
                    <div dir="ltr">
                        <div id="simple-pie" class="apex-charts" data-colors="#3bc0c3,#6c757d,#4489e4,#d03f3f,#edc755">
                        </div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Simple Donut Chart</h4>
                    <div dir="ltr">
                        <div id="simple-donut" class="apex-charts" data-colors="#3bc0c3,#6c757d,#4489e4,#d03f3f,#edc755">
                        </div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Basic Polar Area Chart</h4>
                    <div dir="ltr">
                        <div id="basic-polar-area" class="apex-charts"
                            data-colors="#3bc0c3,#6c757d,#4489e4,#d03f3f,#edc755,#33b0e0"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Monochrome Polar Area</h4>
                    <div dir="ltr">
                        <div id="monochrome-polar-area" class="apex-charts" data-colors="#f24f7c"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Basic Radar Chart</h4>
                    <div dir="ltr">
                        <div id="basic-radar" class="apex-charts" data-colors="#4489e4"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Radar with Polygon-fill</h4>
                    <div dir="ltr">
                        <div id="radar-polygon" class="apex-charts" data-colors="#d03f3f"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Basic RadialBar Chart</h4>
                    <div dir="ltr">
                        <div id="basic-radialbar" class="apex-charts" data-colors="#3bc0c3"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Multiple RadialBars</h4>
                    <div dir="ltr">
                        <div id="multiple-radialbar" class="apex-charts" data-colors="#3bc0c3,#4489e4,#edc755,#33b0e0">
                        </div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->
@endsection

@section('script')
    <!-- Apex Chart Area Demo js -->
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <script src="https://apexcharts.com/samples/assets/series1000.js"></script>
    <script src="https://apexcharts.com/samples/assets/github-data.js"></script>
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
    <!-- Apex Chart Candlestick Demo js -->
    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.8.17/dayjs.min.js"></script>
    @vite(['resources/js/admin/demo/apex.init.js'])
@endsection
