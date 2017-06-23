@extends('admin.layouts.app')

@section('content')
	<div class="container">
		<div class="podcast_files">
			<h3>Podcast <a href="{{ route('podcast.create') }}" style="float: right;">
					<button class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"> Add</i></button>
				</a>
			</h3>

			@if (session()->has('flash_notification.message'))
				<div class="alert alert-{{ session('flash_notification.level') }}">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{!! session('flash_notification.message') !!}
				</div>
			@endif

			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12" style="background: #eae7e7;padding:25px;">
					@if(count($podcast) > 0)
					<table id="podcast_table"  width="100%" class="display cell-border">
						<thead>
							<th>Title</th>
							<th>Poster</th>
							<th>Artist</th>
							<th>Tags</th>
							<th>Language</th>
							<th>Action</th>
						</thead>
						<tbody>
						@foreach($podcast as $new)
							<tr>
								<td>{{ $new->title }}</td>
								<td>
									<img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$new->poster) !!}" alt="Podcast by {{ $new->artist }}" width="100" height="100">
								</td>
								<td>{!! $new->artist !!}</td>
								<td>
									@foreach(unserialize($new->tags) as $tag)
										{{ $tag }}
									@endforeach
								</td>
								<td>{!! $new->language !!}</td>
								<td>
									{{ Form::open(array('route' => array('podcast.edit', $new->id ), 'method' => 'get')) }}
										<button class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"> Edit</i></button>
									{{ Form::close() }}
									&nbsp;&nbsp;&nbsp;&nbsp;
									{{ Form::open(array('route' => array('podcast.destroy', $new->id ), 'method' => 'delete')) }}
										<button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"> Delete</i></button>
									{{ Form::close() }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					@else
						<h3>No Podcast Found !!</h3>
					@endif
				</div>
			</div>
		</div>
	</div>

	<script>
        $(function () {
            $("#podcast_table").DataTable({
//                "scrollY": 200,
                "scrollX": true,
                "order": [[ 0, "desc" ],[ 2, "desc" ],[ 3, "desc" ],[ 4, "desc" ]]
            });
        });
	</script>
@endsection