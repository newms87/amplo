@extends('amplo.layout')
@section('title', "AmploWeb")
@section('header-title', "AmploWeb")

@section('page-body')
    <div id="my-profile">
        <div class="row profile-header">
            <div class="logo">
                <img src="{{url('img/amploweb-logo.png')}}"/>
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


