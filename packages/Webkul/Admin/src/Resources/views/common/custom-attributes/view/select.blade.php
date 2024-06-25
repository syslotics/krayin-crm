@php

    $option = $attribute->lookup_type
        ? app('Webkul\Attribute\Repositories\AttributeRepository')->getLookUpEntity($attribute->lookup_type, $value)
        : $attribute->options()->where('id', $value)->first();
@endphp

@if($attribute->code == "lead_source_id")
    @include ('admin::common.custom-attributes.view.website', ['value' => $lead->additional ?? ''])
@else 
    {{ $option ? $option->name : __('admin::app.common.not-available') }}
@endif