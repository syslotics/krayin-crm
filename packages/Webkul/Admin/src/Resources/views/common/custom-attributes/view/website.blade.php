
@if (! empty($value))
    <span class="multi-value">
        {{  $value['name'] }}
    </span>

    <a 
        href="{{  $value['link'] }}" 
        target="_blank"
    >
        <span style="word-wrap: break-word">
            {{  $value['link'] }}
        </span>
    </a>
@else
    {{ __('admin::app.common.not-available') }}
@endif