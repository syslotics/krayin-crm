@if ($value)
    {{ $value . ' (24-hour clock)' ?? __('admin::app.common.not-available')}}
@endif