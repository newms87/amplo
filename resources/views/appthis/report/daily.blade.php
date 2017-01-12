<div id="daily-report" class="col xs-12 xl-6 align-top">
    <div class="report">
        <div class="report-header row">
            <div class="col xs-8 text-left">
                <h3>30-day Report</h3>
            </div>
            <div class="col xs-4 text-right">
                <a class="btn btn-sm" @click="refresh">
                <i class="fa fa-refresh" :class="{'fa-spin': isRefreshing}"></i>
                </a>
            </div>
        </div>

        <div class="report-body">
            <grid :data="gridData" :columns="gridColumns" :sortby="'date'" :sortorder="1"></grid>
        </div>

        <div class="report-footer row text-left">
            <div class="col xs-12 md-4 filter-date-range">
                <div class="input-group input-group-xs">
                    <label for="filter-date-range" class="addon bg-info color-default border-info">
                        <i class="fa fa-calendar"></i> Start
                    </label>
                    <input id="filter-date-start" name="date_start" v-model="dateStart" class="form-control date-range-picker border-info"/>
                </div>
            </div>
            <div class="col xs-12 md-4 filter-date-range text-left">
                <div class="input-group input-group-xs">
                    <label for="filter-date-range" class="addon bg-info color-default border-info">
                        <i class="fa fa-calendar"></i> End
                    </label>
                    <input id="filter-date-end" name="date_end" v-model="dateEnd" class="form-control date-range-picker border-info"/>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent

    <script type="text/javascript">
		 var dailyReport = new Vue({
			 el:      '#daily-report',
			 data:    {
				 dateStart:    moment().subtract(1, 'month').format('Y-M-D'),
				 dateEnd:      moment().format('Y-M-D'),
				 isRefreshing: false,
				 gridColumns:  [
					 {name: 'date', label: 'Date', align: 'left'},
					 {name: 'impressions', label: 'Impressions'},
					 {name: 'conversions', label: 'Conversions'},
					 {name: 'conversion_rate', label: 'Conversion Rate', filter: 'floatToPercent'}
				 ],
				 gridData:     []
			 },
			 methods: {
				 refresh:   function() {
					 var $this = this;

					 $this.isRefreshing = true;

					 this.$http.get('/appthis/conversion/daily', {params: this.getParams()}).then(function(response) {
						 $this.isRefreshing = false;

						 response.json().then(function(json) {
							 $this.gridData = json;
						 })
					 })
				 },
				 getParams: function() {
					 return {
						 date_start: this.dateStart,
						 date_end:   this.dateEnd,
					 };
				 }
			 },
			 watch:   {
				 dateStart: function() {
					 this.refresh();
				 },
				 dateEnd:   function() {
					 this.refresh();
				 }
			 },
			 created: function() {
				 this.refresh();
			 },
			 mounted: function() {
				 var $this = this;

				 var startDate = new Pikaday({
					 field:    document.getElementById('filter-date-start'),
					 showTime: false,
					 onSelect: function() {
						 $this.dateStart = this.getMoment().format('Y-M-D');
					 }
				 });

				 var endDate = new Pikaday({
					 field:    document.getElementById('filter-date-end'),
					 showTime: false,
					 onSelect: function() {
						 $this.dateEnd = this.getMoment().format('Y-M-D')
					 }
				 });
			 }
		 })
    </script>
@endsection

