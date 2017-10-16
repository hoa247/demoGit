<div id="tbl_list" style="padding: 0px;" class="panel-body">
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