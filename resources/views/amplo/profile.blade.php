@extends('amplo.layout')
@section('title', "AmploWeb")
@section('body-class', 'my-profile')

@section('header-title')
    <div class="col auto header-logo">
        <img src="{{url('img/min/amploweb-logo@1x.png')}}" srcset="{{url('img/min/amploweb-logo@2x')}} 2x, {{url('img/min/amploweb-logo@3x')}} 3x"/>
    </div>
@endsection

@section('page-body')
    <div id="my-profile">
        <div class="row profile-header">
            <div class="logo">

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('components.modal')

    <script>
		 var myProfile = new Vue({
			 el:      '#my-profile',
			 data:    {},
			 methods: {}
		 })
    </script>
@endsection


