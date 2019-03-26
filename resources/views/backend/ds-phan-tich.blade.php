@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('Danh sách kết quả phân tích') }}
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('Năm')</th>
                            <th>@lang('Quốc lộ')</th>
                            <th>@lang('Đoạn')</th>
                            <th>@lang('Chiều đường')</th>
                            <th>@lang('Làn đường')</th>
                        <!-- <th>@lang('Chiều dài')</th> -->
                            <th>@lang('Thao tác')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($roads as $road)
                            <tr>
                                <td>{{ $road['nam_khao_sat'] }}</td>
                                <td>{{ $road['ma_tuyen_duong'] }}</td>
                                <td>{{ $road['ma_tuyen_nhanh'] }}</td>
                                <td>{{ $road['chieu_duong'] == 0 ? "Phải" : "Trái" }}</td>
                                <td>{{ $road['ma_thu_tu_lan'] }}</td>
                            <!--     <td>{{ $road['chieu_dai'].' km' }}</td> -->
                                <td>{!! $road['action_buttons'] !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">

                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
