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
                            {{ html()->form('POST', route('admin.phan-tich-moi'))->attribute('enctype', 'multipart/form-data')->open() }}
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
                                    <i class="fas fa-envelope"></i> Tổng số ảnh: 300 ảnh<br/>
                                    <i class="fas fa-envelope"></i> Năm khảo sát TTMĐ: {{ $road['nam_khao_sat'] }}<br/>
                                </small>
                            </p>                            
                        </div>
                    </div>
                </div><!--col-md-4-->

                <div id="app" class="col-md-8 order-2 order-sm-2">
                    <div class="row">   
                        <div class="col">
                            <script type="text/javascript">
                                imageFiles = @json($imageFiles);
                            </script>
                            <example-component></example-component>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--col-md-8-->
                <div class="col-md-2 order-3 order-sm-3">
                    <div class="card mb-4 bg-light">
                        <div class="card-header">Kết quả phân tích trên toàn đoạn</div>
                        <div class="card-body">
                            <p class="card-text">
                                    Tỷ lệ nứt trung bình: 5% <br/>
                                     ... <br/>
                                    ... <br/>
                                    ... <br/>
                                    ... <br/>
                            </p>                            
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">Thao tác</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('frontend.user.account')}}" class="btn btn-primary btn-block" style="margin-bottom:4px;white-space: normal;min-height: 50px">
                                        @lang('Lưu lại xác thực nhận diện vết nứt')
                                    </a>
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('frontend.user.account')}}" class="btn btn-primary btn-block" style="margin-bottom:4px;white-space: normal;min-height: 50px">
                                        @lang('Xuất kết quả')
                                    </a>
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('frontend.user.account')}}" class="btn btn-primary btn-block" style="margin-bottom:4px;white-space: normal;min-height: 50px">
                                        @lang('Quay lại phân tích mới')
                                    </a>
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('frontend.user.account')}}" class="btn btn-primary btn-block" style="margin-bottom:4px;white-space: normal;min-height: 50px">
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
