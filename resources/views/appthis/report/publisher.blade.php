<div id="publisher-report" class="col xs-12 xl-6 align-top">
    <div class="report ">
        <div class="report-header row">
            <div class="col xs-8 text-left">
                <h3>Publisher Performance</h3>
            </div>
            <div class="col xs-4 text-right">
                <a class="btn btn-sm" @click="refresh">
                <i class="fa fa-refresh" :class="{'fa-spin': isRefreshing}"></i>
                </a>
            </div>
        </div>
        <div class="report-body">
            <grid :data="gridData" :columns="gridColumns" :sortby="'impressions'" :sortorder="-1"></grid>
        </div>
    </div>
</div>

@section('scripts')
    @parent

    <script type="text/javascript">
		 var publisherReport = new Vue({
			 el:      '#publisher-report',
			 data:    {
				 isRefreshing: false,
				 gridColumns:  [
					 {name: 'name', label: 'Publisher', align: 'left'},
					 {name: 'impressions', label: 'Impressions'},
					 {name: 'conversions', label: 'Conversions'},
					 {name: 'conversion_rate', label: 'Conversion Rate', filter: 'floatToPercent'}
				 ],
				 gridData:     []
			 },
			 methods: {
				 refresh: function() {
					 var $this = this;

					 $this.isRefreshing = true;

					 this.$http.get('/appthis/publisher/stats').then(function(response) {
						 $this.isRefreshing = false;

						 response.json().then(function(json) {
							 $this.gridData = json;
						 })
					 })
				 }
			 },
			 created: function() {
				 this.refresh();
			 }
		 })
    </script>
@endsection
