<template>
    <div class="card">
        <div class="card-header">
            <i class="fas fa-code"></i> Example Vue Component
        </div>
        <div class="card-body" style="overflow:auto; max-height:1000px">
            <div>
              <p v-for="item in list">
                <img v-bind:src="'/'+item" style="width:100%"></img>
              </p>
              <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        },
        data() {
            return {
              list: [],
              page: 1,
            };
        },
        methods: {
            infiniteHandler($state) {
                let vm = this;

                /* this.$http.get('/posts?page='+this.page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        $.each(data.data, function(key, value) {
                                vm.list.push(value);
                        });
                        $state.loaded();
                    });

                */
                vm.list.push(imageFiles[this.page]);
                $state.loaded();
                this.page = this.page + 1;
            },
        },        
    }
</script>
