<li>
    <label>
        <input type="checkbox" name="category_id[]" value="{{ $cate_first->id }}"/>
        {{ $cate_first->name }}
    </label>
</li>
@if ($child_cate->categories)
<ul>
    @foreach ($child_cate->categories as $cate_first)
        @include('products.child-cate-add', ['child_cate' => $cate_first])
    @endforeach
</ul>
@endif