@extends('admin.layouts.app')

@section('content')
	<a href="{{ route('admin.dashboard') }}">Dashboard</a>
	<a href="{{ route('news.create') }}">Add News</a>
	@if(count($news) > 0)
		<table>
		@foreach($news as $new)
			<tr>
				<td>{{ $new->id }}</td>
				<td>{{ $new->title }}</td>
				<td>{!! $new->description !!}</td>
				<td>
				<img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$new->poster) !!}" alt="News by {{ $new->title }}" width="100" height="100">
				</td>
				<td>
					@foreach(unserialize($new->tags) as $tag)
                        {{ $tag }}
                    @endforeach
                </td>
				<td><a href="{{ route('news.edit', ['id' => $new->id ]) }}">Edit</a></td>
				<td>
					{{ Form::open(array('route' => array('news.destroy', $new->id ), 'method' => 'delete')) }}
						<button type="submit" >Delete</button>
					{{ Form::close() }}</td>
			</tr>
		@endforeach
		</table>
	@endif
@endsection