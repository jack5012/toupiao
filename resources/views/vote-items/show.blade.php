{{ $voteItem->name }}
{!! $voteItem->desc !!}
{{ $voteItem->voted }}

@if (count($images = $voteItem->images))
    @foreach ($images as $image)
        <p>图片 {{ $image }}</p>
    @endforeach
@endif
