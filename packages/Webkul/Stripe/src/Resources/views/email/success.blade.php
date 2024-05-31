<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @lang('stripe::app.email.success.subject')
    </title>
</head>

<body>
    <div style="text-align: center;">
        <a href="{{ config('app.url') }}">
            <img src="{{ asset('vendor/webkul/admin/assets/images/logo.svg') }}" alt="{{ config('app.name') }}"/>
        </a>
    </div>

    <div style="padding: 30px;">
        <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('stripe::app.email.success.dear', ['name' => $name]),
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('stripe::app.email.success.info', ['id' => '#'.$quote->id])
            </p>

            <p style="text-align: center;padding: 20px 0;">
                <a
                    href="{{ route('admin.quotes.edit', ['id' => $quote->id]) }}" 
                    style="padding: 10px 20px;background: #0041FF;color: #ffffff;text-transform: uppercase;text-decoration: none; font-size: 16px"
                >
                    @lang('stripe::app.email.success.view', ['id' => $quote->id])
                </a>
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('stripe::app.email.success.thanks')
            </p>

        </div>
    </div>
</body>
</html>