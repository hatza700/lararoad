<div class="card">
        <div class="card-header">                        
            <div class="row">
                <div class="col-sm-6">
                    @php
                        $file1 = explode('/', $imageFiles[0]);
                        $file1 = $file1[count($file1)-1];
                        $file2 = explode('/', $imageFiles[count($imageFiles)-1]);
                        $file2 = $file2[count($file2)-1];
                    @endphp
                    <i class="fas fa-code"></i> Phân tích chi tiết: {{ $file1 }} - {{ $file2 }}
                </div>
                <div class="col-sm-6">                    
                    <div class="row">
                        <div class="col-sm-3 p-1">
                            {{ html()->form('POST', url()->current())->open() }}
                            {{ html()->input()->name('prev')->type('hidden')->value($page-1) }}
                            {{ html()->button('Trước')->type('submit')->value(1)->class('btn btn-primary btn-block') }}                            
                            {{ html()->form()->close() }}
                        </div>                        
                        <div class="col-sm-6">
                            {{ html()->form('POST', url()->current())->class('row')->open() }}
                                <div class="col-sm-8 p-1">
                                    {{ html()->select('new_page', $pages, $page)->class('form-control') }}
                                </div>                         
                                <div class="col-sm-4 p-1">
                                    {{ html()->input()->name('goto')->type('hidden')->value(1) }}
                                    {{ html()->button('Tới')->attribute('name', 'goto')->type('submit')->value(1)->class('btn btn-primary btn-block') }}
                                </div>
                            {{ html()->form()->close() }}
                        </div>
                        <div class="col-sm-3 p-1">
                            {{ html()->form('POST', url()->current())->open() }}
                            {{ html()->input()->name('next')->type('hidden')->value($page+1) }}
                            {{ html()->button('Sau')->type('submit')->value(1)->class('btn btn-primary btn-block') }}
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        <div class="card-body" style="overflow:auto; max-height:1000px">
            @foreach($imageFiles as $key => $img_url)
                @php
                    $list = $listArray[$key];
                @endphp
                <div class="container img-container p-0">
                    <svg viewBox="0 0 100 37.5" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="smallGrid" width="0.125" height="0.333333" patternUnits="objectBoundingBox">
                                <path d="M 250 0 L 0 0 0 250" fill="none" stroke="rgba(255, 255, 255, 1)" stroke-width="0.3333" />
                            </pattern>
                        </defs>
                        <image href="/{{ $img_url }}" x="0" y="0" height="100%"/>
                        <rect width="100%" height="100%" fill="url(#smallGrid)" />
                            @if ($list)
                              <g>
                                @foreach($list as $r)                                
                                        @php
                                            $y = $r[0]/20;
                                            $x = $r[1]/20;
                                        @endphp
                                        <rect x="{{ $x }}" y="{{ $y }}" width="5" height="5" fill="none" stroke="rgba(0, 255, 0, 0.7)" stroke-width="0.15"></rect>
                                    
                                @endforeach
                              </g>
                              @endif
                    </svg>
                </div>
            @endforeach    
        </div>

</div>