<template id="progress-bar-template">
    <div id="progress-bar" class="col">
        <div class="bar-header row text-left">
            <h1>Your Progress</h1>
        </div>
        <div class="bar-body row">
            <div class="bar-content">
                <div class="bar-box row">
                    <div class="col auto bar-label">Reached:</div>
                    <div class="col auto bar-slider">
                        <div class="bar-view">
                            <div class="bar-width" :style="{width: barProgress}"></div>
                        </div>

                        <div class="bar-helper" :style="{left: barProgress}">
                            <i class="fa fa-chevron-up"></i>
                            <div class="bar-progress-text">@{{progress | currency}}</div>
                        </div>
                    </div>
                    <div class="col auto bar-target">
                        <div class="target-text">Target</div>
                        <div class="target">@{{target | currency}}</div>
                    </div>
                </div>
                <div class="bar-info row">
                    <i class="fa fa-info-circle info-icon"></i>
                    <span class="text">You need @{{remaining | currency}} more to reach your target</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	Vue.component('progress-bar', {
		template: '#progress-bar-template',
		props:    {
			target:   0,
			progress: 0
		},
		filters:  {
			currency: function(n) {
				return '$' + n;
			}
		},
		computed: {
			remaining:   function() {
				return this.target - this.progress;
			},
			barProgress: function() {
				return (100 * this.progress / this.target) + '%';
			}
		}
	})
</script>

