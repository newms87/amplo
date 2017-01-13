@extends('test.layout')
@section('title', "My Account")
@section('header-title', "My Account")

@section('page-body')
    <div id="my-account">
        <div class="row account-page">
            <h2>Account Information:</h2>

            <a class="btn show-progress" @click="showProgressBar">Progress</a>
        </div>

        <div id="progress-bar-modal" v-if="barVisible">
            <div class="col-align"></div>
            <div class="modal-content col">
                <progress-bar :target="target" :progress="progress"></progress-bar>
            </div>
            <div class="overlay" @click="hideProgressBar"></div>
    </div>
    </div>
@endsection

@section('scripts')
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


