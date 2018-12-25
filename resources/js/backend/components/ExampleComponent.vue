<template>
    <div class="card">
        <div class="card-header">
            <i class="fas fa-code"></i> Ảnh sau khi phân tích
        </div>
        <div class="card-body" style="overflow:auto; max-height:1000px">
            <div>
              <div v-for="item in list">
                <img v-bind:src="'/'+item" style="width:100%"></img>
              </div>
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
                var n;
                if (Array.isArray(imageFiles)) {
                    n = imageFiles.length;
                } else {
                    n = _.size(imageFiles);
                }
                vm.list.push(imageFiles[n-this.page+1]);
                $state.loaded();
                this.page = this.page + 1;
            },
        },        
    }
</script>
