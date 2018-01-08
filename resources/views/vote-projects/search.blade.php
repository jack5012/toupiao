<form action="" method="post">
    {{ csrf_field() }}
<input name="search" type="text">
<input type="submit">
</form>

@if (isset($voteSearch) && count($voteItems = $voteSearch->voteItem))
    @foreach ($voteItems as $voteItem)
        <p> {{ $voteItem->main_image }}</p>
        <p> {{ $voteItem->name }}</p>
        <p> {{ $voteItem->desc }}</p>
        <p> {{ $voteItem->voted }}</p>
    @endforeach
@else
    没有找到匹配的搜索结果！
@endif