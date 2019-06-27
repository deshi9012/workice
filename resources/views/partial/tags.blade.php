@admin
<div class="m-xs">
    @foreach($tags as $tag)
    <span class="label bg-{{ array_random(['info','success','danger','warning','primary']) }} tag-m">@icon('solid/tag') {{ $tag->name }}</span>
    @endforeach
</div>
@endadmin
