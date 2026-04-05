<a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ $links[0] }}">
    <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
    <h4 style="margin:0">EDIT<br>ITEM</h4>
</a>
<br>
<form action="{{ $links[1] }}" method="post" onsubmit="return confirm('Are you sure you want to delete this?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn item-btn action-btn delete-btn d-flex justify-content-between align-items-center">
        <i class="bi-trash3" style="font-size:3em;line-height:1em"></i>
        <h4 style="margin:0">DELETE<br>ITEM</h4>
    </button>
</form>