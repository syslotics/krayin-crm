<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>

    <title>@lang('stripe::app.cancel.index.cancel')</title>
</head>

<body>
    <div class="container">
        <div class="">

            <div style="text-align: center;">
                <a href="{{ config('app.url') }}">
                    <img src="{{ asset('vendor/webkul/admin/assets/images/logo.svg') }}" alt="{{ config('app.name') }}"/>
                </a>
            </div>
            
            <div style="text-align: center;">
                <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
                    <h1 style="font-size: 24px;">
                        @lang('stripe::app.cancel.index.cancel')
                    </h1>
                </div>

                <p style="font-size: 16px;">
                    @lang('stripe::app.cancel.index.info')
                </p>

                <a href="{{ route('admin.quotes.edit', ['id' => $quoteId]) }}" style="padding: 10px 20px;background: #0041FF;color: #ffffff;text-transform: uppercase;text-decoration: none; font-size: 16px">
                    @lang('stripe::app.cancel.index.return-btn' , ['id' => $quoteId])
                </a>
            </div>
        </div>
    </div>
</body>
</html>