@extends('layouts.master')
@section('content')


<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">{{$student->name}}</h1>
                </div>
                <div class="col-auto">
                     <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                              
                            </div>
                            <div class="col-auto">
                              
                            </div>
                            <div class="col-auto">
               
                            </div>
                        </div>
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
            <div class="row g-4">

                <div class="col-3 col-md-3 col-xl-3 col-xxl-3">
                    <div class="app-card app-card-doc shadow-sm h-100">
                        <div class="app-card-thumb-holder p-3">
                            <span class="icon-holder">
                                <i class="fas fa-file-alt text-file"></i>
                            </span>
                          
                             <a class="app-card-link-mask" href="{{ route('studentdetail',$student->id)  }}"></a>
                        </div>
                        <div class="app-card-body p-3 has-card-actions">
                            
                            <h4 class="app-doc-title" ><a style="text-align: center" href="{{ route('studentdetail',$student->id)  }}">Details</a></h4>
                    
                            
                            <div class="app-card-actions">
                               
                            </div><!--//app-card-actions-->
                                
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div><!--//col-->
                
                <div class="col-3 col-md-3 col-xl-3 col-xxl-3">
                    <div class="app-card app-card-doc shadow-sm h-100">
                        <div class="app-card-thumb-holder p-3">
                            <span class="icon-holder">
                                <i class="fas fa-file-pdf pdf-file"></i>
                            </span>
                            <a class="app-card-link-mask" href="{{ route('studentsyllabus',$student->id)  }}"></a>
                        </div>
                        <div class="app-card-body p-3 has-card-actions">
                            <h4 class="app-doc-title truncate mb-0"><a href="{{ route('studentsyllabus',$student->id)}}">Syllabus</a></h4>
                            <div class="app-doc-meta">
                             
                            </div><!--//app-doc-meta-->
                            
                            <div class="app-card-actions">
                                <div class="dropdown">
                                  
                    
                                </div><!--//dropdown-->
                            </div><!--//app-card-action-->
                        </div><!--//app-card-body-->
                    </div>
                </div>

                <div class="col-3 col-md-3 col-xl-3 col-xxl-3">
                    <div class="app-card app-card-doc shadow-sm h-100">
                        <div class="app-card-thumb-holder p-3">
                            <span class="icon-holder">
                                <i class="fas fa-file-alt text-file"></i>
                            </span>
                          
                             <a class="app-card-link-mask" href="  {{ route('studentupdates',$student->id)}}"></a>
                        </div>
                        <div class="app-card-body p-3 has-card-actions">
                            
                            <h4 class="app-doc-title truncate mb-0"><a href="{{ route('studentupdates',$student->id)}}">Daily updates</a></h4>
                            <div class="app-doc-meta">
                            </div>
                            <div class="app-card-actions">
                              
                            </div><!--//app-card-actions-->
                                
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div><!--//col-->

                <div class="col-3 col-md-3 col-xl-3 col-xxl-3">
                    <div class="app-card app-card-doc shadow-sm h-100">
                        <div class="app-card-thumb-holder p-3">
                            <span class="icon-holder">
                                <i class="fas fa-file-pdf pdf-file"></i>
                            </span>
                            <a class="app-card-link-mask" href="{{ route('studentatt',$student->id)  }}"></a>
                        </div>
                        <div class="app-card-body p-3 has-card-actions">
                            <h4 class="app-doc-title truncate mb-0"><a href="{{ route('studentatt',$student->id)}}">Attendance</a></h4>
                            <div class="app-doc-meta">
                             
                            </div>
                            
                            <div class="app-card-actions">
                                <div class="dropdown">
                                   
                    
                                </div><!--//dropdown-->
                            </div><!--//app-card-actions-->
                                
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div><!--//col-->

                <div class="col-3 col-md-3 col-xl-3 col-xxl-3">
                    <div class="app-card app-card-doc shadow-sm h-100">
                        <div class="app-card-thumb-holder p-3">
                            <span class="icon-holder">
                                <i class="fas fa-file-pdf pdf-file"></i>
                            </span>
                            <a class="app-card-link-mask" href="{{ route('getparalist',$student->id)  }}"></a>
                        </div>
                        <div class="app-card-body p-3 has-card-actions">
                            <h4 class="app-doc-title truncate mb-0"><a href="{{ route('getparalist',$student->id)}}">Structure</a></h4>
                            <div class="app-doc-meta">
                             
                            </div>
                            
                            <div class="app-card-actions">
                              
                            </div><!--//app-card-actions-->
                                
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div><!--//col-->

            </div><!--//row-->
       
        </div><!--//container-fluid-->
    </div><!--//app-content-->

    
</div><!--//app-wrapper-->    					


@endsection