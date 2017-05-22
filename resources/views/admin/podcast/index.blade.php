@extends('admin.layouts.app')

@section('content')
	<a href="{{ route('admin.dashboard') }}">Dashboard</a>
	<a href="{{ route('podcast.create') }}">Add Podcast</a>
	@if(count($podcast) > 0)
		<table>
		@foreach($podcast as $new)
			<tr>
				<td>{{ $new->id }}</td>
				<td>{{ $new->title }}</td>
				<td>{!! $new->description !!}</td>
				<td>
				<img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$new->poster) !!}" alt="Podcast by {{ $new->artist }}" width="100" height="100">
				</td>
				<td>
					@foreach(unserialize($new->tags) as $tag)
                        {{ $tag }}
                    @endforeach
                </td>
                <td>{!! $new->artist !!}</td>
                <td>{!! $new->language !!}</td>
				<td><a href="{{ route('podcast.edit', ['id' => $new->id ]) }}">Edit</a></td>
				<td>
				{{ Form::open(array('route' => array('podcast.destroy', $new->id ), 'method' => 'delete')) }}
    					<button type="submit" >Delete</button>
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
		</table>
	@endif
@endsection