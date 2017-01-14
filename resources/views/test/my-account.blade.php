@extends('test.layout')
@section('title', "My Account")
@section('header-title', "My Account")

@section('page-body')
    <div id="my-account">
        <div class="row account-page">
            <h2>Account Information:</h2>

            <a class="btn show-progress" v-on:click="showProgressBar">Progress</a>
        </div>

        <modal v-if="barVisible" v-on:close="hideProgressBar">
            <progress-bar :target="target" :progress="progress"></progress-bar>
        </modal>
    </div>
@endsection

@section('scripts')
    @include('components.modal')
    @include('test.progress-bar')

    <script>
		 var testVue = new Vue({
			 el:      '#my-account',
			 data:    {
				 progress:   0,
				 target:     125,
				 barVisible: false
			 },
			 methods: {
				 showProgressBar: function() {
					 var $this = this;

					 $this.barVisible = true;

					 setTimeout(function() {
						 $this.progress = 56;
					 }, 50)
				 },
				 hideProgressBar: function() {
					 this.barVisible = false;
					 this.progress = 0;
				 }
			 }
		 })
    </script>
@endsection


