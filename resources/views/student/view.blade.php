@extends('layouts.master')
@section('content')


<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
       
        <div class="container-xl">
            
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <script>
                        </script>
                    <?php $city1 = $student->address;
                    $city = explode(",",$city1)[0];?>
                    <div style="position: absolute; right: 0; padding:5px; margin:0px">
                 <?php if($student->status == 0 ){
                    ?>
        
                    <form action="{{route('discontinue_students',$student->id)}}" meyhod="post">
                        @csrf
                        @method('POST')
                      
                        <h2> <a  class="btn btn-secondary"   data-bs-toggle="modal"  data-bs-target="#staticBackdrop1">Active </a>
                        <?php }else{?>
                            <a   class="btn btn-secondary">Discontinue </a>
                            <?php }?>
                        </h2>
                    </div>
                    <h2 class="app-page-title mb-0">Name:{{$student->name}} &nbsp; &nbsp;Admission No:{{$student->admission_no}} &nbsp; &nbsp; City:{{$city}} &nbsp; &nbsp;&nbsp; 
                   </h2>
                    
                   

                 
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
            </div>
            <!--//row-->
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
                <?php if ($student->course_id == 2){?>

                <div class="col-3 col-md-3 col-xl-3 col-xxl-3">
                    <div class="app-card app-card-doc shadow-sm h-100">
                        <div class="app-card-thumb-holder p-3">
                            <span class="icon-holder">
                             
                                <i class="fas fa-file-alt text-file"></i>
                            </span>
                            <a class="app-card-link-mask" href="{{ route('hifz_details',$student->id)  }}"></a>
                        </div>
                        <div class="app-card-body p-3 has-card-actions">
                            <h4 class="app-doc-title truncate mb-0"><a href="{{ route('hifz_details',$student->id)}}">Hifz Detail</a></h4>
                            <div class="app-doc-meta">
                             
                            </div>
                            
                            <div class="app-card-actions">
                              
                            </div><!--//app-card-actions-->
                                
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div>
                <?php  }?><!--//col-->
           <?php if ($student->course_id == 2){?>

               <div class="col-3 col-md-3 col-xl-3 col-xxl-3">
                   <div class="app-card app-card-doc shadow-sm h-100">
                       <div class="app-card-thumb-holder p-3">
                           <span class="icon-holder">
                              <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
                               <i class='fas fa-exclamation'  style="font-size:36px;color:red"></i>

                               {{-- <i class="fas fa-file-pdf pdf-file"></i> --}}
                           </span>
                           <a class="app-card-link-mask" href="{{ route('mistake_table',$student->id)  }}"></a>
                       </div>
                       <div class="app-card-body p-3 has-card-actions">
                           <h4 class="app-doc-title truncate mb-0"><a href="{{ route('mistake_table',$student->id)}}">Mistake Details</a></h4>
                           <div class="app-doc-meta">
                            
                           </div>
                           
                           <div class="app-card-actions">
                               <div class="dropdown">
                                  
                   
                               </div><!--//dropdown-->
                           </div><!--//app-card-actions-->
                               
                       </div><!--//app-card-body-->
                     
                   </div><!--//app-card-->
          <?php  }?>

                </div>
            </div><!--//row-->
       
        </div><!--//container-fluid-->
    </div><!--//app-content-->

    
</div><!--//app-wrapper-->    					

<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Remark</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Remark Here</label>
                <input type="text" name="remark" class="form-control" id="recipient-name" >
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </form>
</div>
@endsection