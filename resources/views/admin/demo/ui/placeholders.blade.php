@extends('admin.layouts.horizontal', ['title' => 'Placeholders', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('admin.layouts.shared/page-title', ['sub_title' => 'Base UI', 'page_title' => 'Placeholders'])

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Placeholders</h4>
                    <p class="text-muted mb-0">
                        In the example below, we take a typical card component and recreate it with placeholders applied to
                        create a “loading card”. Size and proportions are the same between the two.
                    </p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border shadow-none mb-md-0">
                                <img src="/images/small/small-1.jpg" class="card-img-top" alt="...">

                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the
                                        bulk of the card's
                                        content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6">
                            <div class="card border shadow-none mb-0" aria-hidden="true">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="180"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#20c997" />
                                </svg>
                                <div class="card-body">
                                    <h5 class="card-title placeholder-glow">
                                        <span class="placeholder col-6"></span>
                                    </h5>
                                    <p class="card-text placeholder-glow">
                                        <span class="placeholder col-7"></span>
                                        <span class="placeholder col-4"></span>
                                        <span class="placeholder col-4"></span>
                                        <span class="placeholder col-6"></span>
                                        <span class="placeholder col-8"></span>
                                    </p>
                                    <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div> <!-- end row-->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Color</h4>
                    <p class="text-muted mb-0">
                        By default, the <code>placeholder</code> uses <code>currentColor</code>. This can be overriden with
                        a custom color or utility class.
                    </p>
                </div>
                <div class="card-body">
                    <span class="placeholder col-12"></span>
                    <span class="placeholder col-12 bg-primary"></span>
                    <span class="placeholder col-12 bg-secondary"></span>
                    <span class="placeholder col-12 bg-success"></span>
                    <span class="placeholder col-12 bg-danger"></span>
                    <span class="placeholder col-12 bg-warning"></span>
                    <span class="placeholder col-12 bg-info"></span>
                    <span class="placeholder col-12 bg-pink"></span>
                    <span class="placeholder col-12 bg-purple"></span>
                    <span class="placeholder col-12 bg-light"></span>
                    <span class="placeholder col-12 bg-dark"></span>
                </div> <!-- end card-body-->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Width</h4>
                    <p class="text-muted mb-0">
                        You can change the <code>width</code> through grid column classes, width utilities, or inline
                        styles.
                    </p>
                </div>
                <div class="card-body">
                    <span class="placeholder col-6"></span>
                    <span class="placeholder w-75"></span>
                    <span class="placeholder" style="width: 25%;"></span>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Sizing</h4>
                    <p class="text-muted mb-0">
                        The size of <code>.placeholder</code>s are based on the typographic style of the parent element.
                        Customize them with sizing modifiers: <code>.placeholder-lg</code>, <code>.placeholder-sm</code>, or
                        <code>.placeholder-xs</code>.
                    </p>
                </div>
                <div class="card-body">
                    <span class="placeholder col-12 placeholder-lg"></span>
                    <span class="placeholder col-12"></span>
                    <span class="placeholder col-12 placeholder-sm"></span>
                    <span class="placeholder col-12 placeholder-xs"></span>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">How it works</h4>
                    <p class="text-muted mb-0">
                        Create placeholders with the <code>.placeholder</code> class and a grid column class (e.g.,
                        <code>.col-6</code>) to set the <code>width</code>. They can replace the text inside an element or
                        as be added as a modifier class to an existing component.
                    </p>
                </div>
                <div class="card-body">
                    <p aria-hidden="true">
                        <span class="placeholder col-6"></span>
                    </p>

                    <a href="#" class="btn btn-primary disabled placeholder col-4" aria-hidden="true"></a>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Animation</h4>
                    <p class="text-muted mb-0">
                        Animate placehodlers with <code>.placeholder-glow</code> or <code>.placeholder-wave</code> to better
                        convey the perception of something being <em>actively</em> loaded.
                    </p>
                </div>
                <div class="card-body">
                    <p class="placeholder-glow">
                        <span class="placeholder col-12"></span>
                    </p>

                    <p class="placeholder-wave mb-0">
                        <span class="placeholder col-12"></span>
                    </p>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row -->
@endsection
