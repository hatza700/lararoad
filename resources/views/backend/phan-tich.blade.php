    @extends('backend.layouts.app')

    @section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

    @section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Phân tích tình trạng nứt mặt đường
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col col-sm-2 order-1 order-sm-1 mb-3">
                    <div class="card mb-4">
                        <div class="card-header">Lựa chọn đoạn khảo sát</div>
                        <div class="card-body">
                            {{ html()->form('POST', route('admin.phan-tich'))->attribute('enctype', 'multipart/form-data')->open() }}
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{ html()->label(__('Tên quốc lộ'))->for('quoc_lo') }}

                                        {{ html()->select('quoc_lo', ['1' => 'Quốc lộ 1', '020' => 'Quốc lộ 2'], $road['ma_tuyen_duong'])
                                            ->class('form-control') }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{ html()->label(__('Thư mục dữ liệu đoạn phân tích'))->for('thu_muc_du_lieu') }}

                                        {{ html()->select('thu_muc_du_lieu', $directories, $folderKey)
                                            ->class('form-control') }}
                                            <br/>

                                        {{ html()->file('images_location')->accept("application/zip")->class('form-control') }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    {{ html()->button('Thực hiện phân tích tự động')->type('submit')->class('btn btn-primary btn-block')->style('margin-bottom:4px; white-space: normal;') }}
                                </div><!--col-->
                            </div><!--row-->
                            {{ html()->form()->close() }}
                        </div>
                    </div><!--card-->

                    <div class="card mb-4 bg-light">
                        <div class="card-header">Thông tin đoạn phân tích</div>
                        <div class="card-body">
                            <p class="card-text">
                                <small>
                                    <i class="fas fa-envelope"></i> Chiều đường:  {{ $road['chieu_duong'] == 0 ? "Phải" : "Trái" }}<br/>
                                    <i class="fas fa-envelope"></i> Mã làn đường: {{ $road['ma_thu_tu_lan'] }}<br/>
                                    <i class="fas fa-envelope"></i> Chiều dài đoạn: {{ $road['chieu_dai'].' km' }}<br/>
                                    <i class="fas fa-envelope"></i> Tổng số ảnh: {{ $allImgCount }} ảnh<br/>
                                    <i class="fas fa-envelope"></i> Năm khảo sát TTMĐ: {{ $road['nam_khao_sat'] }}<br/>
                                </small>
                            </p>                            
                        </div>
                    </div>
                </div><!--col-md-4-->

                <div id="app" class="col-md-8 order-2 order-sm-2">
                    <div class="row">   
                        <div class="col">
                           @include('backend.includes.partials.images-panel')
                        </div><!--col-->
                    </div><!--row-->
                </div><!--col-md-8-->
                <div class="col-md-2 order-3 order-sm-3">
                    <div class="card mb-4 bg-light">
                        <div class="card-header">Kết quả phân tích trên toàn đoạn</div>
                        <div class="card-body">
                            <p class="card-text">
                                    Tỷ lệ nứt trung bình: <b>{{ number_format($rateArray[0], 2) }}%</b> <br/>
                                    Tỷ lệ ô nứt 100%: <b>{{ number_format($rateArray[1], 2) }}%</b> <br/>
                                    Tỷ lệ ô nứt 65%: <b>{{ number_format($rateArray[2], 2) }}%</b> <br/>
                            </p>                            
                        </div>
                    </div>

                    <div class="card mb-4 bg-light">
                        <div class="card-header">Kết quả phân tích trên phân đoạn đang hiển thị</div>
                        <div class="card-body">
                            <p class="card-text">
                                    Tỷ lệ nứt trung bình: <b>{{ number_format($rateArray[0], 2) }}%</b> <br/>
                                    Tỷ lệ ô nứt 100%: <b>{{ number_format($rateArray[1], 2) }}%</b> <br/>
                                    Tỷ lệ ô nứt 65%: <b>{{ number_format($rateArray[2], 2) }}%</b> <br/>
                            </p>                            
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">Thao tác</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{ html()->form('POST', url()->current())->open() }}
                                    {{ html()->input()->name('save')->type('hidden')->attribute("id", "savedata") }}
                                    <button type="submit" class="btn btn-primary btn-block" style="margin-bottom:4px;white-space: normal;min-height: 50px" onclick="return saveModify(this, {{ '"'.strtoupper($directories[$folderKey]).'"' }});">
                                        @lang('Lưu lại xác thực nhận diện vết nứt')
                                    </button>
                                    {{ html()->form()->close() }}
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('admin.xuat-ket-qua', $folder)}}" class="btn btn-primary btn-block" style="margin-bottom:4px;white-space: normal;min-height: 50px">
                                        @lang('Xuất kết quả')
                                    </a>
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('admin.ds-phan-tich') }}" class="btn btn-primary btn-block" style="margin-bottom:4px;white-space: normal;min-height: 50px">
                                        @lang('Quay lại phân tích mới')
                                    </a>
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('admin.ds-phan-tich') }}" class="btn btn-primary btn-block" style="margin-bottom:4px;white-space: normal;min-height: 50px">
                                        @lang('Kết thúc')
                                    </a>
                                </div><!--col-->
                            </div><!--row-->
                        </div>
                    </div><!--card-->
                </div><!--col-md-8-->
            </div><!-- row -->
        </div><!--card-body-->
    </div><!--card-->

    @endsection

    @push('scripts')
    <script type="text/javascript">
        function initMatrix() {
            return [[0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0]];
        }

        function addRed(url, i, j) {
            var ustore = JSON.parse(sessionStorage.getItem(url));
            if (!ustore)
                ustore = initMatrix();
            ustore[parseInt(i)][parseInt(j)] = 2;
            sessionStorage.setItem(url, JSON.stringify(ustore));
            var ustore1 = sessionStorage.getItem(url);
            console.log(ustore1);
        }

        function addYellow(url, i, j) {
            var ustore = JSON.parse(sessionStorage.getItem(url));
            if (!ustore)
                ustore = initMatrix();
            ustore[parseInt(i)][parseInt(j)] = 1;
            sessionStorage.setItem(url, JSON.stringify(ustore));
            var ustore1 = sessionStorage.getItem(url);
            console.log(ustore1);
        }

        function removeColor(url, i, j) {
            var ustore = JSON.parse(sessionStorage.getItem(url));
            if (ustore) {
                ustore[parseInt(i)][parseInt(j)] = 0;
                sessionStorage.setItem(url, JSON.stringify(ustore));
                var ustore1 = sessionStorage.getItem(url);
                console.log(ustore1);
            }            
        }

        function saveModify(btn, folder) {
            var str = "{";            
            for(var fname in sessionStorage)
            {
                if (folder === fname.substring(0, folder.length)) {
                    if (str !== "{")
                        str += ',';
                    str += '"'+fname+'":'+sessionStorage.getItem(fname);
                    sessionStorage.removeItem(fname);
                }
            }
            str += '}';
            document.getElementById("savedata").value = str;
            return true;
        }

        function updateLocalMatrix(ele) {
            var url = ele.getAttribute("name");   
            var i, childs = ele.children;  
            var ustore = JSON.parse(sessionStorage.getItem(url));
            if (!ustore)
                ustore = initMatrix();          
            
            var red = 'rgba(255, 0, 0, 0.1)',
                red7 = 'rgba(255, 0, 0, 0.7)',
                white = 'rgba(255, 255, 255, 0)',
                yellow = 'rgba(255, 255, 0, 0.1)',
                yellow7 = 'rgba(255, 255, 0, 0.7)';

            for (i = 0; i < childs.length; i++) {
                var c = childs[i];
                if (c.nodeName == "rect") {
                    var fill = c.getAttribute("fill");
                    if (fill === red) {
                        ustore[parseInt(c.getAttribute("posi"))][parseInt(c.getAttribute("posj"))] = 2;
                    } else if (fill === white) {
                        ustore[parseInt(c.getAttribute("posi"))][parseInt(c.getAttribute("posj"))] = 0;
                    } else if (fill === yellow) {
                        ustore[parseInt(c.getAttribute("posi"))][parseInt(c.getAttribute("posj"))] = 1;
                    }
                }
            }

            sessionStorage.setItem(url, JSON.stringify(ustore));
        }

        function doRectClick(myrect){
            var fill = myrect.getAttribute("fill");
            var url = myrect.parentElement.getAttribute("name");
            var i = myrect.getAttribute("posi"),
                j = myrect.getAttribute("posj");            
            //var results = sessionStorage.getItem(url);

            //sessionStorage.setItem(url, "Hello World");
            
            var red = 'rgba(255, 0, 0, 0.1)',
                red7 = 'rgba(255, 0, 0, 0.7)',
                white = 'rgba(255, 255, 255, 0)',
                yellow = 'rgba(255, 255, 0, 0.1)',
                yellow7 = 'rgba(255, 255, 0, 0.7)';


            if (fill === red) {
                myrect.setAttribute("fill", white);
                myrect.setAttribute("stroke", white);                
                updateLocalMatrix(myrect.parentElement);
            } else if (fill === white) {
                myrect.setAttribute("fill", yellow);
                myrect.setAttribute("stroke", yellow7);
                updateLocalMatrix(myrect.parentElement);
            } else if (fill === yellow) {
                myrect.setAttribute("fill", red);
                myrect.setAttribute("stroke", red7);
                updateLocalMatrix(myrect.parentElement);
            }
            //myrect.style.fill = 'rgba(' + r + ', ' + g + ' , ' + b + ', 0.3)';            
        }
    </script>
    @endpush
