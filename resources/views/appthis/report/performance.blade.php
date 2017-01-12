<div id="performance-report" class="col xs-12 xl-6 align-top">
    <div class="report chart">
        <div class="report-header row">
            <div class="col xs-8 text-left">
                <h3>Performance Report</h3>
            </div>
            <div class="col xs-4 text-right">
                <a class="btn btn-sm" @click="refresh">
                    <i class="fa fa-refresh" :class="{'fa-spin': isRefreshing}"></i>
                </a>
            </div>
        </div>

        <div class="report-body">
            <chart :id="'performance-chart'" :rows="chartRows" :columns="chartColumns" :type="'Line'"></chart>
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
            <div class="col xs-12 md-6 filter-country text-left">
                <div class="input-group input-group-xs">
                    <label for="filter-country" class="addon bg-info color-default border-info">
                        Country
                    </label>
                    <select id="filter-country" v-model="country" class="form-control border-info">
                        <option value="">(All Countries)</option>
                        <option v-for="country in countries" :value="country">@{{country}}</option>
                    </select>
                </div>
            </div>
            <div class="col xs-12 md-6 filter-publisher text-left">
                <div class="input-group input-group-xs">
                    <label for="filter-publisher" class="addon bg-info color-default border-info">
                        Publisher
                    </label>
                    <select id="filter-publisher" v-model="publisher_id" class="form-control border-info">
                        <option value="">(All Publishers)</option>
                        <option v-for="publisher in publishers" :value="publisher.id">@{{publisher.name}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent

    <script type="text/javascript">
	    var performanceReport = new Vue({
			 el:      '#performance-report',
			 data:    {
				 countries:    [],
				 publishers:   [],
				 publisher_id: '',
				 country:      '',
				 dateStart:    moment().subtract(1, 'month').format('Y-M-D'),
				 dateEnd:      moment().format('Y-M-D'),
				 isRefreshing: false,
				 chartColumns: [
					 {type: 'string', label: 'Date'},
					 {type: 'number', label: 'iPhone'},
					 {type: 'number', label: 'iPad'},
					 {type: 'number', label: 'Android'}
				 ],
				 chartRows:    []
			 },
			 methods: {
				 refresh:   function() {
					 var $this = this;

					 $this.isRefreshing = true;

					 this.$http.get('/appthis/conversion/performance', {params: this.getParams()}).then(function(response) {
						 $this.isRefreshing = false;

						 response.json().then(function(json) {
							 $this.chartRows = json;
						 })
					 })
				 },
				 getParams: function() {
					 return {
						 date_start:   this.dateStart,
						 date_end:     this.dateEnd,
						 country:      this.country,
						 publisher_id: this.publisher_id
					 };
				 }
			 },
			 watch:   {
				 dateStart:    function() {
					 this.refresh();
				 },
				 dateEnd:      function() {
					 this.refresh();
				 },
				 country:      function() {
					 this.refresh();
				 },
				 publisher_id: function() {
					 this.refresh();
				 }
			 },
			 mounted: function() {
				 var $this = this;

				 new Pikaday({
					 field:    document.getElementById('filter-date-start'),
					 showTime: false,
					 onSelect: function() {
						 $this.dateStart = this.getMoment().format('Y-M-D');
					 }
				 });

				 new Pikaday({
					 field:    document.getElementById('filter-date-end'),
					 showTime: false,
					 onSelect: function() {
						 $this.dateEnd = this.getMoment().format('Y-M-D')
					 }
				 });

				 this.$http.get('/appthis/conversion/get-countries').then(function(response) {
					 response.json().then(function(countries) {
						 $this.countries = countries
					 })
				 })

				 this.$http.get('/appthis/publisher/get').then(function(response) {
					 response.json().then(function(publishers) {
						 $this.publishers = publishers
					 })
				 })

				 this.refresh();
			 }
		 })
    </script>
@endsection

