@extends('admin.layouts.horizontal', ['title' => 'Remix Icons', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('admin.layouts.shared/page-title', ['sub_title' => 'Icons', 'page_title' => 'Remix Icons'])

    <div class="row">
        <div class="col-12" id="icons"></div> <!-- end col-->
    </div><!-- end row -->
    <!-- end row -->
@endsection

@section('script')
    <!-- Remixicons Icons Demo js -->
    @vite(['resources/js/admin/demo/icons-remix.init.js'])
@endsection
