<template>
    <div class="card">
        <div class="card-header">
            <i class="fas fa-code"></i> Ảnh sau khi phân tích
        </div>
        <div class="card-body" style="overflow:auto; max-height:1000px">
            <div>
              <div v-for="item in list">
                <div class="container img-container p-0" v-bind:style="{ backgroundImage: 'url(/' + item.img_url + ')', backgroundSize: 'auto 100%', backgroundRepeat: 'no-repeat' }">
                  <div class="row m-0">
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[0]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[1]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[2]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[3]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[4]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[5]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[6]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[7]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                  </div>
                  <div class="row m-0">
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[8]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[9]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[10]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[11]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[12]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[13]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[14]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[15]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                  </div>
                  <div class="row m-0">
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[16]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[17]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[18]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[19]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[20]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[21]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[22]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': item.crack_matrix[23]}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                  </div>
                </div>
              </div>

              <infinite-loading @distance="10" @infinite="infiniteHandler"></infinite-loading>

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
                var n;
                var zero_matrix = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                if (Array.isArray(imageFiles)) {
                    n = imageFiles.length;
                } else {
                    n = _.size(imageFiles);
                }
                var img_url = imageFiles[n-this.page];
                var json_url = imageFiles[n-this.page]+".json";
                console.log(img_url);

                this.$http.get('/'+json_url)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        //$.each(data.data, function(key, value) {
                        //        vm.list.push(value);
                        //});
                        var item = {img_url: img_url, crack_matrix: data};
                        vm.list.push(item);
                        $state.loaded();
                    }).catch((error) => {
                        //console.log(error);
                        var item = {img_url: img_url, crack_matrix: zero_matrix};
                        vm.list.push(item);
                        $state.loaded();
                    });;

                //vm.list.push(imageFiles[n-this.page]);
                //$state.loaded();
                this.page = this.page + 1;
            },
        },        
    }
</script>
