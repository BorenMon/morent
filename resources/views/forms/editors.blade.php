@extends('layouts.vertical', ['title' => 'Editors', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    <!-- Quill css -->
    @vite(['node_modules/quill/dist/quill.core.css', 'node_modules/quill/dist/quill.snow.css', 'node_modules/quill/dist/quill.bubble.css'])
@endsection

@section('content')
    @include('layouts.shared/page-title', ['sub_title' => 'Forms', 'page_title' => 'Editors'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Quill Editor</h4>
                    <p class="text-muted mb-0">Snow is a clean, flat toolbar theme.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="mb-2">
                            <div id="snow-editor" style="height: 300px;">
                                <h3><span class="ql-size-large">Hello World!</span></h3>
                                <p><br></p>
                                <h3>This is an simple editable area.</h3>
                                <p><br></p>
                                <ul>
                                    <li>
                                        Select a text to reveal the toolbar.
                                    </li>
                                    <li>
                                        Edit rich document on-the-fly, so elastic!
                                    </li>
                                </ul>
                                <p><br></p>
                                <p>
                                    End of simple area
                                </p>
                            </div><!-- end Snow-editor-->
                        </div>
                    </li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-1">Bubble Editor</h5>
                    <p class="text-muted mb-0">Bubble is a simple tooltip based theme.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="mb-2">
                            <div id="bubble-editor" style="height: 300px;">
                                <h3><span class="ql-size-large">Hello World!</span></h3>
                                <p><br></p>
                                <h3>This is an simple editable area.</h3>
                                <p><br></p>
                                <ul>
                                    <li>
                                        Select a text to reveal the toolbar.
                                    </li>
                                    <li>
                                        Edit rich document on-the-fly, so elastic!
                                    </li>
                                </ul>
                                <p><br></p>
                                <p>
                                    End of simple area
                                </p>
                            </div> <!-- end Snow-editor-->

                        </div>
                    </li>
                </ul> <!-- end list-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->
@endsection


@section('script')
    @vite(['resources/js/pages/quilljs.init.js'])
@endsection
