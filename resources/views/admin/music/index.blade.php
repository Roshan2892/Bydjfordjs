@extends('admin.layouts.app')

@section('content')
	<div class="container">
		<div class="links">
			<ul>
				<li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('music.create') }}">Add Music</a></li>
			</ul>
		</div>
		<div class="music_files">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12" style="background: #eae7e7;padding:25px;">
					@if(count($music) > 0)
						<table border="1">
							<tr>
								<td>ID</td>
								<td>Title</td>
								<td>Description</td>
								<td>Poster</td>
								<td>Tags</td>
								<td>Artist</td>
								<td>Language</td>
								<td colspan="2">Action</td>
							</tr>
							@foreach($music as $new)
								<tr>
									<td>{{ $new->id }}</td>
									<td>{{ $new->title }}</td>
									<td>{!! $new->description !!}</td>
									<td>
										<img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$new->poster) !!}" alt="Music by {{ $new->artist }}" width="100" height="100">
									</td>
									<td>
										@foreach(unserialize($new->tags) as $tag)
					                        {{ $tag }}
					                    @endforeach
					                </td>
					                <td>{!! $new->artist !!}</td>
					                <td>{!! $new->language !!}</td>
									<td>
										<a href="{{ route('music.edit', ['id' => $new->id ]) }}">Edit</a>
										{{ Form::open(array('route' => array('music.destroy', $new->id ), 'method' => 'delete')) }}
					    					<button type="submit" >Delete</button>
										{{ Form::close() }}
									</td>
								</tr>
							@endforeach
						</table>
					@else
						<h3>No Albums Found !!</h3>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection