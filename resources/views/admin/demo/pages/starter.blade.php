@extends('admin.layouts.horizontal', ['title' => 'Starter Page', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('admin.layouts.shared/page-title', ['sub_title' => 'Pages', 'page_title' => 'Starter'])
@endsection
