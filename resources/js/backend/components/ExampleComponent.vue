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
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[0][0] >= 32), 'is_cracked2': (item.crack_matrix[0][0]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[0][1] >= 32), 'is_cracked2': (item.crack_matrix[0][1]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[0][2] >= 32), 'is_cracked2': (item.crack_matrix[0][2]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[0][3] >= 32), 'is_cracked2': (item.crack_matrix[0][3]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[0][4] >= 32), 'is_cracked2': (item.crack_matrix[0][4]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[0][5] >= 32), 'is_cracked2': (item.crack_matrix[0][5]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[0][6] >= 32), 'is_cracked2': (item.crack_matrix[0][6]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[0][7] >= 32), 'is_cracked2': (item.crack_matrix[0][7]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                  </div>
                  <div class="row m-0">
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[1][0] >= 32), 'is_cracked2': (item.crack_matrix[1][0]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[1][1] >= 32), 'is_cracked2': (item.crack_matrix[1][1]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[1][2] >= 32), 'is_cracked2': (item.crack_matrix[1][2]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[1][3] >= 32), 'is_cracked2': (item.crack_matrix[1][3]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[1][4] >= 32), 'is_cracked2': (item.crack_matrix[1][4]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[1][5] >= 32), 'is_cracked2': (item.crack_matrix[1][5]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[1][6] >= 32), 'is_cracked2': (item.crack_matrix[1][6]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[1][7] >= 32), 'is_cracked2': (item.crack_matrix[1][7]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                  </div>
                  <div class="row m-0">
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[2][0] >= 32), 'is_cracked2': (item.crack_matrix[2][0]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[2][1] >= 32), 'is_cracked2': (item.crack_matrix[2][1]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[2][2] >= 32), 'is_cracked2': (item.crack_matrix[2][2]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[2][3] >= 32), 'is_cracked2': (item.crack_matrix[2][3]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[2][4] >= 32), 'is_cracked2': (item.crack_matrix[2][4]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[2][5] >= 32), 'is_cracked2': (item.crack_matrix[2][5]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[2][6] >= 32), 'is_cracked2': (item.crack_matrix[2][6]>=61)}]" style="padding-bottom:98%">
                            
                        </a>
                    </div>
                    <div class="col-sm p-1">
                        <a href="#" v-bind:class="['btn', 'rounded-0', 'btn-block', 'pt-0', 'pl-0', 'pr-0', {'is_cracked': (item.crack_matrix[2][7] >= 32), 'is_cracked2': (item.crack_matrix[2][7]>=61)}]" style="padding-bottom:98%">
                            
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

                this.$http.get('/'+json_url+'?'+Date.now())
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        //$.each(data.data, function(key, value) {
                        //        vm.list.push(value);
                        //});
                        console.log(img_url);
                        console.log(data);
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
