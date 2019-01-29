<div class="card">
        <div class="card-header">                        
            <div class="row">
                <div class="col-sm-3">
                    @php
                        $file1 = explode('/', $imageFiles[0]);
                        $file1 = $file1[count($file1)-1];
                        $file2 = explode('/', $imageFiles[count($imageFiles)-1]);
                        $file2 = $file2[count($file2)-1];
                    @endphp
                    <i class="fas fa-code"></i> {{ $file1 }} - {{ $file2 }}
                </div>
                <div class="col-sm-9">                    
                    <div class="row">
                        <div class="col-sm-4">
                            {{ html()->form('POST', url()->current())->class('row')->open() }}
                                <div class="col-sm-5 p-1">
                                    {{ html()->input()->name('display')->type('hidden')->value(1) }}
                                    {{ html()->button('Hiển thị')->attribute('name', 'display')->type('submit')->value(1)->class('btn btn-primary btn-block') }}
                                </div>
                                <div class="col-sm-5 p-1">
                                    @php
                                        $arr1 = array_merge(array(2), range(10, 50, 10));
                                        $arr2 = array_combine($arr1, $arr1);
                                    @endphp
                                    {{ html()->select('new_display_img', $arr2, $displayImg)->class('form-control') }}
                                </div>
                                <div class="col-sm-2 p-0"> 
                                    ảnh / tr.
                                </div>                       
                                
                            {{ html()->form()->close() }}
                        </div>                        
                        <div class="col-sm-2 p-1">
                            {{ html()->form('POST', url()->current())->open() }}
                            {{ html()->input()->name('prev')->type('hidden')->value($page-1) }}
                            {{ html()->button('Trước')->type('submit')->value(1)->class('btn btn-primary btn-block') }}                            
                            {{ html()->form()->close() }}
                        </div>                        
                        <div class="col-sm-4">
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
                        <div class="col-sm-2 p-1">
                            {{ html()->form('POST', url()->current())->open() }}
                            {{ html()->input()->name('next')->type('hidden')->value($page+1) }}
                            {{ html()->button('Sau')->type('submit')->value(1)->class('btn btn-primary btn-block') }}
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        <div class="card-body" style="overflow:auto; max-height:50000px">
            @foreach($imageFiles as $key => $img_url)
                @php
                    $list = $listArray[$key];
                    $list250 = $list250Array[$key];
                    $listFix = $listFixArray[$key];
                @endphp
                <div class="img-container p-0">
                    <svg viewBox="0 0 100 37.5" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="smallGrid" width="0.125" height="0.333333" patternUnits="objectBoundingBox">
                                <path d="M 250 0 L 0 0 0 250" fill="none" stroke="rgba(255, 255, 255, 1)" stroke-width="0.3333" />
                            </pattern>
                        </defs>
                        <image href="/{{ $img_url }}" x="0" y="0" height="100%"/>
                        <rect x="87.5" y="0" width="12.5" height="37.5" fill="white"></rect>
                        <rect width="100%" height="100%" fill="url(#smallGrid)" />
                                @php
                                    $urls = explode('/', $img_url, 3);
                                @endphp
                              <g name =  "{{ $urls[2] }}">
                                @foreach($list as $r)                                
                                        @php
                                            $y = $r[0]/20;
                                            $x = $r[1]/20;
                                        @endphp
                                        <rect x="{{ $x }}" y="{{ $y }}" width="5" height="5" fill="none" stroke="rgba(0, 255, 0, 0.7)" stroke-width="0.15"></rect>
                                    
                                @endforeach
                                @foreach($list250 as $i => $row)
                                    @foreach($row as $j => $col)
                                        @php
                                            if ($j == 7)
                                                continue;
                                            $t = 0.3;
                                            $s = 0.3;
                                            $y = $i*12.5+$t+$s;
                                            $x = $j*12.5+$t+$s;
                                            $h = 12.5-2*$t-2*($s-0.1);
                                            if (!empty($listFix))
                                                $color = $listFix[$i][$j];
                                            else
                                                $color = ($col >= 61?2:($col >= 25?1:0));
                                        @endphp
                                        @if ($color == 2)
                                        <rect x="{{ $x }}" y="{{ $y }}" width="{{ $h }}" height="{{ $h }}" fill="rgba(255, 0, 0, 0.1)" stroke="rgba(255, 0, 0, 0.7)" stroke-width="{{ $s }}" onclick="doRectClick(this)" posi="{{ $i }}" posj="{{ $j }}"></rect>
                                        @elseif ($color == 1)
                                        <rect x="{{ $x }}" y="{{ $y }}" width="{{ $h }}" height="{{ $h }}" fill="rgba(255, 255, 0, 0.1)" stroke="rgba(255, 255, 0, 0.7)" stroke-width="{{ $s }}" onclick="doRectClick(this)" posi="{{ $i }}" posj="{{ $j }}"></rect>
                                        @else
                                        <rect x="{{ $x }}" y="{{ $y }}" width="{{ $h }}" height="{{ $h }}" fill="rgba(255, 255, 255, 0)" stroke="rgba(255, 255, 255, 0)" stroke-width="{{ $s }}" onclick="doRectClick(this)" posi="{{ $i }}" posj="{{ $j }}"></rect>
                                        @endif
                                    @endforeach    
                                @endforeach
                              </g>
                    </svg>
                </div>
                @endforeach    
        </div>
        <div class="card-header">                        
            <div class="row">
                <div class="col-sm-3">
                    <i class="fas fa-code"></i> {{ $file1 }} - {{ $file2 }}
                </div>
                <div class="col-sm-9">                    
                    <div class="row">
                        <div class="col-sm-4">
                            {{ html()->form('POST', url()->current())->class('row')->open() }}
                                <div class="col-sm-5 p-1">
                                    {{ html()->input()->name('display')->type('hidden')->value(1) }}
                                    {{ html()->button('Hiển thị')->attribute('name', 'display')->type('submit')->value(1)->class('btn btn-primary btn-block') }}
                                </div>
                                <div class="col-sm-5 p-1">
                                    {{ html()->select('new_display_img', $arr2, $displayImg)->class('form-control') }}
                                </div>
                                <div class="col-sm-2 p-0"> 
                                    ảnh / tr.
                                </div>                       
                                
                            {{ html()->form()->close() }}
                        </div>                        
                        <div class="col-sm-2 p-1">
                            {{ html()->form('POST', url()->current())->open() }}
                            {{ html()->input()->name('prev')->type('hidden')->value($page-1) }}
                            {{ html()->button('Trước')->type('submit')->value(1)->class('btn btn-primary btn-block') }}                            
                            {{ html()->form()->close() }}
                        </div>                        
                        <div class="col-sm-4">
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
                        <div class="col-sm-2 p-1">
                            {{ html()->form('POST', url()->current())->open() }}
                            {{ html()->input()->name('next')->type('hidden')->value($page+1) }}
                            {{ html()->button('Sau')->type('submit')->value(1)->class('btn btn-primary btn-block') }}
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>            
            </div>
        </div>

</div>