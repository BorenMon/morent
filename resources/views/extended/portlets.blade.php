@extends('layouts.vertical', ['title' => 'Portlets', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['sub_title' => 'Extended', 'page_title' => 'Portlets'])

    <div class="row">
        <div class="col-xl-4 col-sm-6 ">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-header">
                    <div class="card-widgets">
                        <a href="javascript:;" data-bs-toggle="reload"><i
                                class="ri-refresh-line"></i></a>
                        <a data-bs-toggle="collapse" href="#card-collapse1" role="button"
                            aria-expanded="false" aria-controls="card-collapse1"><i
                                class="ri-subtract-line"></i></a>
                        <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                    </div>
                    <h5 class="card-title mb-0">Default Heading</h5>
                </div>
                <div id="card-collapse1" class="collapse show">
                    <div class="card-body">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content. Some quick example text to build on the card title and make up.
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

        <div class="col-xl-4 col-sm-6 ">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="card-widgets">
                        <a href="javascript:;" data-bs-toggle="reload"><i
                                class="ri-refresh-line"></i></a>
                        <a data-bs-toggle="collapse" href="#card-collapse2" role="button"
                            aria-expanded="false" aria-controls="card-collapse2"><i
                                class="ri-subtract-line"></i></a>
                        <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                    </div>
                    <h5 class="card-title mb-0">Primary Heading</h5>
                </div>
                <div id="card-collapse2" class="collapse show">
                    <div class="card-body">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content. Some quick example text to build on the card title and make up.
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

        <div class="col-xl-4 col-sm-6 ">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-widgets">
                        <a href="javascript:;" data-bs-toggle="reload"><i
                                class="ri-refresh-line"></i></a>
                        <a data-bs-toggle="collapse" href="#card-collapse3" role="button"
                            aria-expanded="false" aria-controls="card-collapse3"><i
                                class="ri-subtract-line"></i></a>
                        <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                    </div>
                    <h5 class="card-title mb-0">Info Heading</h5>
                </div>
                <div id="card-collapse3" class="collapse show">
                    <div class="card-body">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content. Some quick example text to build on the card title and make up.
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

        <div class="col-xl-4 col-sm-6 ">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <div class="card-widgets">
                        <a href="javascript:;" data-bs-toggle="reload"><i
                                class="ri-refresh-line"></i></a>
                        <a data-bs-toggle="collapse" href="#card-collapse4" role="button"
                            aria-expanded="false" aria-controls="card-collapse4"><i
                                class="ri-subtract-line"></i></a>
                        <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                    </div>
                    <h5 class="card-title mb-0">Success Heading</h5>
                </div>
                <div id="card-collapse4" class="collapse show">
                    <div class="card-body">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content. Some quick example text to build on the card title and make up.
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

        <div class="col-xl-4 col-sm-6 ">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <div class="card-widgets">
                        <a href="javascript:;" data-bs-toggle="reload"><i
                                class="ri-refresh-line"></i></a>
                        <a data-bs-toggle="collapse" href="#card-collapse5" role="button"
                            aria-expanded="false" aria-controls="card-collapse5"><i
                                class="ri-subtract-line"></i></a>
                        <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                    </div>
                    <h5 class="card-title mb-0">Warning Heading</h5>
                </div>
                <div id="card-collapse5" class="collapse show">
                    <div class="card-body">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content. Some quick example text to build on the card title and make up.
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

        <div class="col-xl-4 col-sm-6 ">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <div class="card-widgets">
                        <a href="javascript:;" data-bs-toggle="reload"><i
                                class="ri-refresh-line"></i></a>
                        <a data-bs-toggle="collapse" href="#card-collapse6" role="button"
                            aria-expanded="false" aria-controls="card-collapse6"><i
                                class="ri-subtract-line"></i></a>
                        <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                    </div>
                    <h5 class="card-title mb-0">Danger Heading</h5>
                </div>
                <div id="card-collapse6" class="collapse show">
                    <div class="card-body">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content. Some quick example text to build on the card title and make up.
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

        <div class="col-xl-4 col-sm-6 ">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="card-widgets">
                        <a href="javascript:;" data-bs-toggle="reload"><i
                                class="ri-refresh-line"></i></a>
                        <a data-bs-toggle="collapse" href="#card-collapse7" role="button"
                            aria-expanded="false" aria-controls="card-collapse7"><i
                                class="ri-subtract-line"></i></a>
                        <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                    </div>
                    <h5 class="card-title mb-0">Dark Heading</h5>
                </div>
                <div id="card-collapse7" class="collapse show">
                    <div class="card-body">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content. Some quick example text to build on the card title and make up.
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

        <div class="col-xl-4 col-sm-6 ">
            <div class="card">
                <div class="card-header bg-pink text-white">
                    <div class="card-widgets">
                        <a href="javascript:;" data-bs-toggle="reload"><i
                                class="ri-refresh-line"></i></a>
                        <a data-bs-toggle="collapse" href="#card-collapse8" role="button"
                            aria-expanded="false" aria-controls="card-collapse8"><i
                                class="ri-subtract-line"></i></a>
                        <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                    </div>
                    <h5 class="card-title mb-0">Pink Heading</h5>
                </div>
                <div id="card-collapse8" class="collapse show">
                    <div class="card-body">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content. Some quick example text to build on the card title and make up.
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

        <div class="col-xl-4 col-sm-6 ">
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="card-widgets">
                        <a href="javascript:;" data-bs-toggle="reload"><i
                                class="ri-refresh-line"></i></a>
                        <a data-bs-toggle="collapse" href="#card-collapse9" role="button"
                            aria-expanded="false" aria-controls="card-collapse9"><i
                                class="ri-subtract-line"></i></a>
                        <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                    </div>
                    <h5 class="card-title mb-0">Purple Heading</h5>
                </div>
                <div id="card-collapse9" class="collapse show">
                    <div class="card-body">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content. Some quick example text to build on the card title and make up.
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->
    </div> <!-- end row -->
@endsection
