<template id="chart-template">
    <div :id="id" class="google-chart"></div>
</template>

<script>
	//Load the Line package from Google Charts
	google.charts.load('current', {'packages': ['line']});

	// register the chart component
	Vue.component('chart', {
		template: '#chart-template',
		gChart:   null,
		props:    {
			id:      String,
			type:    String,
			rows:    Array,
			columns: Array
		},
		data:     function() {
			return {
				chartRows:    [],
				chartOptions: {
					animation:       {duration: 1000, startup: true, easing: 'out'},
					backgroundColor: {fill: 'transparent'},
					chartArea:       {
						top:   10,
						left:  50,
						width: '93%'
					}
				},
			}
		},
		mounted:  function() {
			var $this = this;

			google.charts.setOnLoadCallback(function() {
				$this.init();
			})
		},
		methods:  {
			init:        function() {
				this.gChart = new google.charts[this.type](document.getElementById(this.id));

				if (this.chartRows.length) {
					this.drawChart();
				}
			},
			drawChart:   function() {
				if (!this.gChart) {
					return;
				}

				var chartData = new google.visualization.DataTable();

				for (var c in this.columns) {
					var col = this.columns[c];
					chartData.addColumn(col.type, col.label);
				}

				chartData.addRows(this.chartRows);

				this.gChart.draw(chartData, this.chartOptions);
			},
			applyFilter: function(value, filter) {
				if (filter && this.$options.filters[filter]) {
					return this.$options.filters[filter](value);
				}

				return value;
			}
		},
		watch:    {
			rows:         function() {
				var rows = [];

				for (var r in this.rows) {
					var row = this.rows[r];
					rows.push(row);
				}

				this.chartRows = rows;
			},
			chartRows:    function() {
				this.drawChart();
			},
			chartOptions: function() {
				this.drawChart();
			}
		}
	})
</script>
