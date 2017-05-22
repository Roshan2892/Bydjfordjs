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
				<a href="{{ route('news.destroy', ['id' => $new->id ]) }}" data-method="delete"  data-confirm="Are you sure you want to delete this?">Delete</a></td>
			</tr>
		@endforeach
		</table>
	@endif
@endsection