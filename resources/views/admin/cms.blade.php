@extends('admin.admin_header')
@section('content')
<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        CMS 
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <div class="row">
                <div class="col-md-12">
                    <div class="card no-b shadow">
                        <div class="card-body">
                            @include('admin.error')
							@if($userData['edit'])
									<form method="POST" action="{{route('cms_update')}}">
										{{ csrf_field() }}
										
										<div class="form-group">
											<label for="title">Title</label>
											<input type="text" class="form-control" name="new_title" value="{{ $userData['editData']->title  }}">
										</div>
										
										<div class="form-group">
											<label for="keyword">Keyword</label>
											<input type="text" class="form-control" name="new_keyword" value="{{ $userData['editData']->keyword  }}">
										</div>
								 
										<div class="form-group">
											<label for="metadescrption">Descrption</label>
											<input type="text" class="form-control" name="new_metadescrption" value="{{ $userData['editData']->metadescrption }}">
										</div>
								 
										<div class="form-group">
											<label for="slug">Slug</label>
											<input type="text" class="form-control" name="new_slug" value="{{ $userData['editData']->slug}}">
										</div>
										
										<div class="form-group">
										<label for="content">Contents</label>
										<textarea class="ckeditor form-control" type="text" name="new_content">{{ $userData['editData']->content}}</textarea>
										</div>
										
										<input type='hidden' value='{{ $userData["edit"] }}' name='editid'>
										<div class="form-group">
											<button style="cursor:pointer" type="submit" class="btn btn-primary">Update</button>
											<button type="button" class="btn btn-primary" onclick="window.location='{{ URL::previous() }}'">Cancel</button>
										</div>
											
									</form>
				@else
								<form method="POST" action="{{route('cms_add')}}">
										{{ csrf_field() }}
										
										<div class="form-group">
											<label for="title">Title</label>
											<input type="text" class="form-control" id="title" name="title">
										</div>
										
										<div class="form-group">
											<label for="keyword">Keyword</label>
											<input type="text" class="form-control" id="keyword" name="keyword">
										</div>
								 
										<div class="form-group">
											<label for="metadescrption">Descrption</label>
											<input type="text" class="form-control" id="metadescrption" name="metadescrption">
										</div>
								 
										<div class="form-group">
											<label for="slug">Slug</label>
											<input type="text" class="form-control" id="slug" name="slug" >
										</div>
								
										<div class="form-group">
										<label for="content">Contents</label>
										<textarea class="ckeditor form-control" name="wysiwyg-editor"></textarea>
										</div>
										
										<div class="form-group">
											<button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
										</div>
									<div class="container-fluid animatedParent animateOnce my-3">
									<div class="animated fadeInUpShort">
										<div class="row">
											<div class="col-md-12">
												<div class="card no-b shadow">
													<div class="card-body">
														<div class="table-responsive">
															<table class="table table-bordered table-hover data-tables" data-options='{"searching":false}'>
																<thead>
																	<tr>
																		<th>Title</th>
																		<th>Keyword</th>
																		<th>Descrption</th>
																		<th>Slug</th>
																		<th>Contents</th>
																		<th>Action</th>
																	</tr>
																</thead>
																<tbody>                                  
																@foreach($userData['data'] as $user)
																<tr>
																	<td>
																		<h6>{{ $user->title }}</h6>
																	</td>
																	<td>
																		<h6>{{ $user->keyword }}</h6>
																	</td>
																	<td>
																		<h6>{{ $user->metadescrption }}</h6>
																	</td>
																	<td><h6>{{ $user->slug }}</h6></td>
																	<td><h6>{{ strip_tags($user->content) }} </h6></td>
																	
																	<td><a style="color:white;" class="btn btn-xs btn-primary" href="{{route('cms')}}/{{$user->id }}">Update</a></button><br><br> <button style="cursor:pointer" type="submit" class="btn btn-xs btn-primary"><a style="color:white;" href="{{ route('cms_delete',['id'=>$user->id]) }}">Delete</a></button></td>
																</tr>
																@endforeach
																</tbody>
																<tfoot>
																	<tr>
																		<th>Title</th>
																		<th>Keyword</th>
																		<th>Descrption</th>
																		<th>Slug</th>
																		<th>Contents</th>
																		<th>Action</th>
																	</tr>
																</tfoot>
															</table>
														</div>
													</div>
												</div>
											</div>
											
										</div>
										{{-- <nav class="pt-3" aria-label="Page navigation">
											<ul class="pagination">
												<li class="page-item"><a class="page-link" href="#">Previous</a>
												</li>
												<li class="page-item"><a class="page-link" href="#">1</a>
												</li>
												<li class="page-item"><a class="page-link" href="#">2</a>
												</li>
												<li class="page-item"><a class="page-link" href="#">3</a>
												</li>
												<li class="page-item"><a class="page-link" href="#">Next</a>
												</li>
											</ul>
										</nav> --}}
									</div>
								</div>	
						  			
									</form>
				@endif
						
									
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</div>
@endsection
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>