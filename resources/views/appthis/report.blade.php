@extends('appthis.layout')
@section('title', "AppThis Reports")
@section('header-title', "AppThis Reports")

@section('page-body')
    <div class="row report-list">
        @include('appthis.report.publisher')

        @include('appthis.report.performance')

        @include('appthis.report.daily')
    </div>
@endsection

@section('scripts')
    @parent

    @include('components.grid')
    @include('components.chart')
@endsection
