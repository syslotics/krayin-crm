@component('admin::emails.layouts.master')
    <div style="text-align: center;">
        <a href="{{ config('app.url') }}">
            <img src="{{ asset('vendor/webkul/admin/assets/images/logo.svg') }}" alt="{{ config('app.name') }}"/>
        </a>
    </div>

    <div style="padding: 30px;">
        <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('stripe::app.email.index.dear', ['name' => $name]),
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('stripe::app.email.index.info')
            </p>

            <p style="text-align: center;padding: 20px 0;">
                <a
                    href="{{ route('stripe.payment', ['quote_id' => $quote->id]) }}" 
                    style="padding: 10px 20px;background: #0041FF;color: #ffffff;text-transform: uppercase;text-decoration: none; font-size: 16px"
                >
                    @lang('stripe::app.email.index.buy-now')
                </a>
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('stripe::app.email.index.thanks')
            </p>

        </div>
    </div>
@endcomponent