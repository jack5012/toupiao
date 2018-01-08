{{ $voteProject->name }}
{!! $voteProject->desc !!}
{{ $voteProject->end }}
{{ $voteProject->visitd }}
{{ $voteProject->involved }}
{{ $voteProject->voted }}

@if (count($slides = $voteProject->slide))
    @foreach ($slides as $slide)
        <p>滚动图 {{ $slide }}</p>
    @endforeach
@endif

@if (count($voteItems = $voteProject->voteItem))
    @foreach ($voteItems as $voteItem)
        <p> {{ $voteItem->main_image }}</p>
        <p> {{ $voteItem->name }}</p>
        <p> {{ $voteItem->desc }}</p>
        <p> {{ $voteItem->voted }}</p>
    @endforeach
@else
    我没有任何记录！
@endif