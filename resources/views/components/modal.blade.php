<template id="modal-template">
    <div :id="id" class="vue-modal">
        <div class="col-align"></div>
        <div class="modal-content col">
            <slot></slot>
        </div>
        <div class="overlay" v-on:click="hide"></div>
    </div>
</template>

<script>
	// register the modal component
	Vue.component('modal', {
		template: '#modal-template',
		props:    {
			id:   String
		},
		data:     function() {
			return {}
		},
		methods:  {
			hide: function() {
				this.$emit('close');
			}
		}
	});
</script>
