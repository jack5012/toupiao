@if (count($voteItems = $voteRanking->voteItem))
    @foreach ($voteItems as $voteItem)
        <p> {{ $voteItem->main_image }}</p>
        <p> {{ $voteItem->name }}</p>
        <p> {{ $voteItem->desc }}</p>
        <p> {{ $voteItem->voted }}</p>
    @endforeach
@else
    我没有任何记录！
@endif