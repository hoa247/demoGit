<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
		$(document).ready(function(){
	  		$('form').find('.form-control').each(function(){
	  		$(this).change(function(){
	  			if($(this).val()==""){
			        $('.'+$(this).attr('name')+'_required').css('display','block');
			        $('.'+$(this).attr('name')+'_alpha').css('display','none');
			        $('.'+$(this).attr('name')+'_numeric').css('display','none');
			        $('.'+$(this).attr('name')+'_valid').css('display','none');
			        $('.'+$(this).attr('name')+'_max').css('display','none');
			        // $('.sub').attr('disabled', true);
			    } else {
			        $('.'+$(this).attr('name')+'_required').css('display','none');
			        if($(this).attr('name')=='c_name'){
				        if($(this).val().length > 100){
					        $('.'+$(this).attr('name')+'_max').css('display','block');
					    } else {
					        $('.'+$(this).attr('name')+'_max').css('display','none');
					    }
					    if(/^[ AÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶEÉÈẺẼẸÊẾỀỂỄỆIÍÌỈĨỊOÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢUÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴĐaáàảãạâấầẩẫậăắằẳẵặeéèẻẽẹêếềểễệiíìỉĩịoóòỏõọôốồổỗộơớờởỡợuúùủũụưứừửữựyýỳỷỹỵđa-zA-Z\s]+$/.test($(this).val())==false){
					        $('.'+$(this).attr('name')+'_alpha').css('display','block');
					    } else {
					        $('.'+$(this).attr('name')+'_alpha').css('display','none');
					    }
					    
					   }
					 if($(this).attr('name')=='c_age'){
					 	if($(this).val().length > 2){
					        $('.'+$(this).attr('name')+'_max').css('display','block');
					    } else {
					        $('.'+$(this).attr('name')+'_max').css('display','none');
					    }
					    if(/^[.0-9\s]+$/.test($(this).val())==false){
					        $('.'+$(this).attr('name')+'_numeric').css('display','block');
					    } else {
					        $('.'+$(this).attr('name')+'_numeric').css('display','none');
					    }
					   }
					   if($(this).attr('name')=='c_address'){
				   		if($(this).val().length > 300){
					        $('.'+$(this).attr('name')+'_max').css('display','block');
					    } else {
					        $('.'+$(this).attr('name')+'_max').css('display','none');
					    }
					    if(/^[ ,<.>/?'";:=+-_)(*&%$@!AÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶEÉÈẺẼẸÊẾỀỂỄỆIÍÌỈĨỊOÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢUÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴĐaáàảãạâấầẩẫậăắằẳẵặeéèẻẽẹêếềểễệiíìỉĩịoóòỏõọôốồổỗộơớờởỡợuúùủũụưứừửữựyýỳỷỹỵđ0-9a-zA-Z\s]+$/.test($(this).val())==false){
					        $('.'+$(this).attr('name')+'_valid').css('display','block');
					    } else {
					        $('.'+$(this).attr('name')+'_valid').css('display','none');
					    }
						  }
			    }
			    	
			    	

			    		var frm = $('#'+$(this).attr('name_frm'));
					    $.ajax({
						            type: frm.attr('method'),
						            url: "check_ajax",
						            data: frm.serialize(),
						            success: function (data) {
						                $('.sub').attr('disabled', false);
						            },
						            error: function (data) {
						                $('.sub').attr('disabled', true);
						            },
						        });

	  		});
	  		$('.add_member').click(function(){
				$('#add_name').val('');
  				$('#add_address').val('');
  				$('#add_age').val('');
  				$('#add_photo').val('');
  				$('.alert').css('display','none');
  				$('.err').css('display','none');
			});
		    
		});

  	});
	</script>
  <style type="text/css">
  	.err{
  		display: none;
		color: red;
  	}
	body{min-width: 790px;}
  </style>
<body>
	<nav class="navbar navbar-inverse ">
	     <a class="navbar-brand" href="{{ url('/') }}">Test app 2</a>
		 <ul class="nav navbar-nav">	
		      <li class="active"><a href="{{ url('/') }}">Home</a></li>
	    </ul>
	</nav>
	<hr>
	<div class="container">
		<!-- add -->
		<span class="btn btn-sm btn-primary add_member" data-toggle="modal" data-target="#addModal" style="margin-bottom: 5px;"><span class="glyphicon glyphicon-plus"></span></span>
		<div class="modal fade" id="addModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Add member</h4>
			        </div>
			        <div class="modal-body">
			          <!-- --------------- -->
			          	<form  id="addForm" method="POST" action="{{ url('add_ajax') }}" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" >
								<div class="row" style="margin-top: 5px;">
									<div class="col-md-2">Name</div>
									<div class="col-md-9">
										<input id="add_name" value="{{ old('c_name') }}" name_frm="addForm" class="form-control" type="text" name="c_name"  >
										<div class="err c_name_required"  >The name field is required.</div>
										<div class="err c_name_alpha"  >The name field may only alphabetic characters.</div>
										<div class="err c_name_max"  >The name may not be greater than 100 characters.</div>
									</div>

								</div>
								<div class="row" style="margin-top: 5px;">
									<div class="col-md-2">Address</div>
									<div class="col-md-9">
										<textarea id="add_address" rows="2" cols="50" name_frm="addForm"  class="form-control" name="c_address">{{ old('c_address') }}</textarea>
										<div class="err c_address_required"  >The address field is required.</div>
										<div class="err c_address_valid"  >The address may only alphabetic characters.</div>
										<div class="err c_address_max"  >The address may not be greater than 300 characters.</div>
										
									</div>
								</div>
								<div class="row" style="margin-top: 5px;">
									<div class="col-md-2">Age</div>
									<div class="col-md-9">
										<input id="add_age" value="{{ old('c_age') }}" name_frm="addForm" class="form-control" type="text" name="c_age" autocomplete="off">
										<div class="err c_age_required" >The age field is required.</div>
										<div class="err c_age_numeric"  >The age field is numeric.</div>
										<div class="err c_age_max"  >The age may not be greater than 2 characters.</div>
									</div>
								</div>
								<div class="row" style="margin-top: 5px;">
									<div class="col-md-2">Photo</div>
									<div class="col-md-9">
										<input id="add_photo" type="file" name="c_photo">
									</div>
								</div>
								<div class="row col-xs-offset-5" style="margin-top: 5px;">
									<input id="sub" disabled  class="sub btn btn-sm btn-primary" type="submit" value="Submit">
									<input class="btn btn-sm btn-danger" type="reset" value="Reset">
								</div>
						</form>
						<style type="text/css">
							.alert{margin-top: 20px;}
							.alert ul li{list-style: none;display: list-item;list-style-type: square;}
						</style>
						
						<div id="err_add"></div>
			          <!-- --------------- -->
			        </div>
			        
		      </div>
			</div>
		</div>
		<!-- end add -->
		<!-- edit -->
		
		<div class="modal fade" id="editModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Edit member</h4>
			        </div>
			        <div class="modal-body">
			          <!-- --------------- -->
			          	<form  id="editForm" method="POST" action="edit_ajax" enctype="multipart/form-data">
			          			<input id="edit_id" type="hidden" name="id" value="{{ old('id') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" >
								<div class="row" style="margin-top: 5px;">
									<div class="col-md-2">Name</div>
									<div class="col-md-9">
										<input value="{{ old('c_name') }}" id="edit_name" name_frm="editForm"  class="form-control" type="text" name="c_name" >
										<div class="err c_name_required"  >The name field is required.</div>
										<div class="err c_name_alpha"  >The name field may only alphabetic characters.</div>
										<div class="err c_name_max"  >The name may not be greater than 100 characters.</div>
									</div>

								</div>
								<div class="row" style="margin-top: 5px;">
									<div class="col-md-2">Address</div>
									<div class="col-md-9">
										<textarea id="edit_address" rows="2" cols="50" name_frm="editForm"  class="form-control" name="c_address">{{ old('c_address') }}</textarea>
										<div class="err c_address_required"  >The address field is required.</div>
										<div class="err c_address_valid"  >The address may only alphabetic characters.</div>
										<div class="err c_address_max"  >The address may not be greater than 300 characters.</div>
										
									</div>
								</div>
								<div class="row" style="margin-top: 5px;">
									<div class="col-md-2">Age</div>
									<div class="col-md-9">
										<input value="{{ old('c_age') }}" id="edit_age" name_frm="editForm" class="form-control" type="text" name="c_age" autocomplete="off">
										<div class="err c_age_required"  >The age field is required.</div>
										<div class="err c_age_numeric"  >The age field is numeric.</div>
										<div class="err c_age_max"  >The age may not be greater than 2 characters.</div>
									</div>
								</div>
								<div class="row" style="margin-top: 5px;">
									<div class="col-md-2">Photo</div>
									<div class="col-md-9">
										<input id="edit_photo" type="file" name="c_photo">
									</div>
								</div>
								<div class="row col-xs-offset-5" style="margin-top: 5px;">
									<input id="sub"  class="sub btn btn-sm btn-primary" type="submit" value="Submit">
									<input class="btn btn-sm btn-danger" type="reset" value="Reset">
								</div>
						</form>
						<style type="text/css">
							.alert{margin-top: 20px;}
							.alert ul li{list-style: none;display: list-item;list-style-type: square;}
						</style>
						
						<div id="err_edit"></div>
			          <!-- --------------- -->
			        </div>
			        
		      </div>
			</div>
		</div>
		<!-- end edit -->
		<style type="text/css">
		    #tr:hover{    background-color: white;}
		    #tr .cursor:hover{    background-color: #f5f5f5;cursor: pointer;}
			.container{min-width: 400px;}
			.name{width: 150px;}
		    .address{width: 500px;}
		    .s_name {width:150px; word-wrap:break-word;display: inline-block;}
		    .s_address {width:500px; word-wrap:break-word;display: inline-block;}
		    @media all and (max-width: 1000px){
		     .name{width: 50px;}
		    .address{width: 100px;}
		    .s_name {width:50px; }
		    .s_address {width:100px; }
		  	}
		  	@media all and (max-width: 800px){
		    
		    .address{display: none;}
		    }
		  	}
		  	
		</style>
		<!-- list member -->
		<div class="panel panel-primary">
			<div class="panel-heading">List member</div>
			<div id="tbl_list" class="panel-body">
				<table class="table table-bordered table-condensed">
					<tr id="tr">
						<th onclick="sort('id')" class="cursor" style="width: 50px;">ID</th>
						<th onclick="sort('c_name')" class="cursor name" style="">Name</th>
						<th onclick="sort('c_address')" class="cursor address" style="">Address</th>
						<th onclick="sort('c_age')" class="cursor" style="width: 75px;">Age</th>
						<th>Photo</th>
						<th style="width: 90px;">Action</th>
					</tr>
					<tbody>
			@foreach($arr as $row)
					<tr>
						<td>{{ $row->id }}</td>
						<td class="name"><span class="s_name">{{ $row->c_name }}</span></td>
						<td class="address"><span class="s_address">{{ $row->c_address }}</span></td>
						<td>{{ $row->c_age }}</td>
						<td style="text-align: center;"><img style="width: 100px;" src="{{ url('demo2/images/'.$row->c_photo) }}"></td>
						<td>
							<span id_member="{{ $row->id }}" onclick="getEdit({{ $row->id }})" class="edit_member btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal"><span class=" glyphicon glyphicon-edit"></span></span>
							<a class="btn btn-sm btn-primary" onclick="getDelete({{ $row->id }})" href="#"><span style="color: white;" class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
			@endforeach
					<tbody>

				</table>
				{{ $arr->links() }}
			</div>
		</div>
		<!-- end list member -->
	</div>
	<script type="text/javascript">
		function sort(sort){
			$.ajax({
			          			url:"sort",
			          			type:"GET",
			          			dataType:"text",
			          			data:{
			          				sort : sort
			          				 },
			          			success: function(result){
			          				 $.get("load_member", function(data){
							            $('#tbl_list').html(data);
							        });
			          			}
			          		});
		}
		function getEdit(id) {
			$('.sub').attr('disabled', false);
			$('.alert').css('display','none');
  			$('.err').css('display','none');
			$('#edit_photo').val('');
			$.ajax({
			          			url:"edit_member",
			          			type:"GET",
			          			dataType:"text",
			          			data:{
			          				id : id
			          				 },
			          			success: function(result){
			          				var result = JSON.parse(result);
			          				$('#edit_name').val(result.c_name);
			          				$('#edit_address').val(result.c_address);
			          				$('#edit_age').val(result.c_age);
			          				$('#edit_id').val(result.id);
			          			}
			          		});
		}
		function getDelete(id){
			if(confirm("Are you sure?")) {
    			$.ajax({
			          			url:"delete_member",
			          			type:"GET",
			          			dataType:"text",
			          			data:{
			          				id : id
			          				 },
			          			success: function(result){
			          				$.get("load_member", function(data){
							            $('#tbl_list').html(data);
							        });
			          			}
			          		});	
			}
		}
		
		$(document).ready(function(){
			$('#addForm').on('submit',function (e){
				e.preventDefault();
				$.ajax({
				        url: 'add_ajax',
				        type: 'POST',
				        data: new FormData(this),
				        async: false,
				        cache: false,
				        contentType: false,
				        processData: false,
				        success: function (data) {
			            	$.get("load_member", function(data){
						            $('#tbl_list').html(data);
						            $('#addModal').modal('hide');
						        });
				        },
				        error: function(data){
					        var data = data.responseJSON;
					        err = data.errors;
					        var html = "<div id='err_add' class='alert alert-danger alert-dismissable'><ul>";
					        Object.keys(err).forEach(function(key) {
								    Object.keys(err[key]).forEach(function(key2) {
								    	html+="<li>"+err[key][key2]+"</li>";
								});
							});
							html+="</ul></div>";
							$('#err_add').html(html);
							$('#err_add').css('display','block');
				    	}
				    });
			})
			$('#editForm').on('submit',function (e){
				e.preventDefault();
				$.ajax({
				        url: 'edit_ajax/'+$('#edit_id').val(),
				        type: 'POST',
				        data: new FormData(this),
				        async: false,
				        cache: false,
				        contentType: false,
				        processData: false,
				        success: function (data) {
				            $.get("load_member", function(data){
							            $('#tbl_list').html(data);
							            $('#editModal').modal('hide');
							        });
				        },
				        error: function(data){
					        var data = data.responseJSON;
					        err = data.errors;
					        var html = "<div id='err_edit' class='alert alert-danger alert-dismissable'><ul>";
					        Object.keys(err).forEach(function(key) {
								    Object.keys(err[key]).forEach(function(key2) {
								    	html+="<li>"+err[key][key2]+"</li>";
								});
							});
							html+="</ul></div>";
							$('#err_edit').html(html);
							$('#err_edit').css('display','block');
				    	}
				    });

			})
			
			$('.add_member').click(function(){
				$('#add_name').val('');
  				$('#add_address').val('');
  				$('#add_age').val('');
  				$('#add_photo').val('');
  				$('.alert').css('display','none');
  				$('.err').css('display','none');
			});
			

		});
	</script>
</body>
</html>