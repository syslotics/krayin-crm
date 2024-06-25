<select @if (! $attribute->code == 'user_id') v-validate="'{{$validations}}'" @endif class="control" id="{{ $attribute->code }}" name="{{ $attribute->code }}" data-vv-as="&quot;{{ $attribute->name }}&quot;" @if ($attribute->code == 'user_id') style="display: none;" @endif>

    @php
        $options = $attribute->lookup_type
            ? app('Webkul\Attribute\Repositories\AttributeRepository')->getLookUpOptions($attribute->lookup_type)
            : $attribute->options()->orderBy('sort_order')->get();

        $selectedOption = old($attribute->code) ?: $value;
    @endphp
    
    @if (! $attribute->code == 'user_id') 
        <option value="" selected="selected" disabled="disabled">{{ __('admin::app.settings.attributes.select') }}</option>
    @endif
    
    @foreach ($options as $option)
        <option value="{{ $option->id }}" {{ $option->id == $selectedOption ? 'selected' : ''}}>
            {{ $option->name }}
        </option>
    @endforeach

</select>