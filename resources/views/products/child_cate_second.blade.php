<li>
    <label>
        <input type="checkbox" name="category_id[]" value="{{ $cate_second['id'] }}"  {{in_array($cate_second->parent_id, $productCategory) ? "checked":"" }} />
        {{ $cate_second->name }}
    </label>
</li>
@if ($child_cate_second->categories)
<ul>
    @foreach ($child_cate_second->categories as $cate_second)
        @include('products.child_cate_second', ['child_cate_second' => $cate_second])
    @endforeach
</ul>
@endif