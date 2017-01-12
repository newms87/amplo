var appthis = new Vue({
	el:      '#page-sub-header',
	data:    {
		numImpressions: '',
		digits:         '',
		genBtnText:     'Generate',
		algBtnText:     'Run Algorithm',
		numTeams:       '',
		isLoading:      false
	},
	methods: {
		generateImpressions: function() {
			if (this.numImpressions) {
				this.genBtnText = 'Generating...';

				this.$http.get('/appthis/generate-impressions', {params: {impressions: this.numImpressions}}).then(function() {
					this.genBtnText = 'Generate';
					this.numImpressions = '';
				});
			} else {
				this.genBtnText = "Enter Value!"
			}
		},
		runAlgorithm:        function() {
			if (this.digits) {
				this.algBtnText = 'Running...';

				var params = {
					digits: this.digits,
					teams: this.numTeams || 2
				};

				this.$http.get('/appthis/algorithm', {params: params}).then(function(response) {
					this.algBtnText = 'Run Algorithm';

					response.json().then(function(json){
						var msg = '';
						for (var n in json.numbers) {
							msg += json.numbers[n] + "\n";
						}
						msg += '= ' + json.total;

						alert(msg);
					});
				});
			} else {
				this.algBtnText = "Add digits first!"
			}
		}
	}
});

/*
 (function($) {
 $(document).ready(function() {
 $('nav, .nav').click(function(e) {
 var $target = $(e.target).closest('li');

 $target.closest('ul').find('.is-active').removeClass('is-active');
 $target.addClass('is-active');
 })

 $('.navbar-toggle').click(function() {
 var $navToggle = $(this);
 var $navTarget = $($navToggle.attr('href'));

 var active = !$navToggle.hasClass('is-active'), width = $navTarget.outerWidth();

 $navToggle.add($navTarget).toggleClass('is-active', active);

 if ($navTarget.hasClass('nav-slide-inline')) {
 if (active) {
 var $navOverlay = $('<div/>').addClass('nav-overlay').one('click', function() {
 $navToggle.click();
 $(this).remove()
 });
 }

 var x = active ? ($navTarget.hasClass('slide-left') ? width : -width) : 0;
 $('#page-container .page-content').css({'transform': "translate3d(" + x + "px,0,0)"});
 $navTarget.after($navOverlay);
 }
 })
 })
 })(jQuery);

 */
