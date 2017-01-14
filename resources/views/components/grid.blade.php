<template id="grid-template">
    <table class="table-grid">
        <thead>
        <tr>
            <th v-for="col in columns" @click="sortBy(col.name)" :class="{ 'is-sorting': sortKey === col.name }" :style="renderStyle(col)">
            @{{col.label}}
            <span class="arrow" :class="sortOrders[col.name] > 0 ? 'asc' : 'dsc'"></span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="entry in sortedData">
            <td v-for="col in columns" :style="renderStyle(col)">
                @{{applyFilter(entry[col.name], col.filter)}}
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
	// register the grid component
	Vue.component('grid', {
		template: '#grid-template',
		props:    {
			data:      Array,
			columns:   Array,
			sortby:    String,
			sortorder: Number
		},
		data:     function() {
			var sortOrders = {}
			this.columns.forEach(function(col) {
				sortOrders[col.name] = 1
			})

			sortOrders[this.sortby] = this.sortorder;

			return {
				sortKey:    this.sortby,
				sortOrders: sortOrders
			}
		},
		computed: {
			sortedData: function() {
				var sortKey = this.sortKey
				var order = this.sortOrders[sortKey] || 1
				var data = this.data

				if (sortKey) {
					data = data.slice().sort(function(a, b) {
						a = a[sortKey]
						b = b[sortKey]
						return (a === b ? 0 : a > b ? 1 : -1) * order
					})
				}

				return data
			},
		},
		filters:  {
			floatToPercent: function(n) {
				return (n * 100).toFixed(2) + '%'
			}
		},
		methods:  {
			sortBy:      function(key) {
				this.sortKey = key
				this.sortOrders[key] = this.sortOrders[key] * -1
			},
			renderStyle: function(col) {
				return {'text-align': col.align || 'right'}
			},
			applyFilter: function(value, filter) {
				if (filter && this.$options.filters[filter]) {
					return this.$options.filters[filter](value);
				}

				return value;
			}
		}
	})
</script>
