<li>
    <label>
        <input type="checkbox" name="category_id[]" value="{{ $cate_first->parent_id }}"  @foreach ($checked as $check => $hitsValue)
        @foreach ($checked->product_category as $value)
            @if(in_array($value['id'], $checked)) 'checked="checked"' @endif
        @endforeach />
        {{ $cate_first->name }}
    </label>
</li>
@if ($child_cate->categories)
<ul>
    @foreach ($child_cate->categories as $cate_first)
        @include('products.child_cate', ['child_cate' => $cate_first])
    @endforeach
</ul>
@endif