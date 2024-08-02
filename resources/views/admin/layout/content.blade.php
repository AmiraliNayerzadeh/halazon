@extends('admin.layout.master')

@section('content')
    {{$slot}}

    @section('script')
        {{ $script ?? ''}}
    @endsection
@endsection
