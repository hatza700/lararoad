@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    

    <div class="row mb-4">
        <div class="col">
            <script type="text/javascript">
                imageFiles = @json($imageFiles);
            </script>
            <example-component></example-component>
        </div><!--col-->
    </div><!--row-->

    
@endsection
