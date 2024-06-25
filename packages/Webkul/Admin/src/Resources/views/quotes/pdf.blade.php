<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <style type="text/css">
            * {
                font-family: DejaVu Sans;
            }

            body, th, td, h5 {
                font-size: 12px;
                color: #000;
            }

            .container {
                padding: 20px;
                display: block;
            }

            .quote-summary {
                margin-bottom: 20px;
            }

            .table {
                margin-top: 20px;
            }

            .table table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
            }

            .table thead th {
                font-weight: 700;
                border-top: solid 1px #d3d3d3;
                border-bottom: solid 1px #d3d3d3;
                border-left: solid 1px #d3d3d3;
                padding: 5px 10px;
                background: #F4F4F4;
            }

            .table thead th:last-child {
                border-right: solid 1px #d3d3d3;
            }

            .table tbody td {
                padding: 5px 10px;
                border-bottom: solid 1px #d3d3d3;
                border-left: solid 1px #d3d3d3;
                color: #3A3A3A;
                vertical-align: middle;
            }

            .table tbody td p {
                margin: 0;
            }

            .table tbody td:last-child {
                border-right: solid 1px #d3d3d3;
            }

           .sale-summary {
                margin-top: 40px;
                float: right;
            }

            .sale-summary tr td {
                padding: 3px 5px;
            }

            .sale-summary tr.bold {
                font-weight: 600;
            }

            .label {
                color: #000;
                font-weight: bold;
            }

            .logo {
                height: 70px;
                width: 70px;
            }

            .text-center {
                text-align: center;
            }
        </style>
    </head>

    <body style="background-image: none; background-color: #fff;">
        <div class="container">

            <div class="header">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">{{ __('admin::app.quotes.quote') }}</h1>
                    </div>
                </div>

                <div class="image">
                    {{-- <img class="logo" src="{{ Storage::url(core()->getConfigData('sales.orderSettings.quote_slip_design.logo')) }}"/> --}}
                </div>
            </div>

            <div class="quote-summary">
                <div class="row">
                    <span class="label">{{ __('admin::app.quotes.quote-id') }} -</span>
                    <span class="value">#{{ $quote->id }}</span>
                </div>

                <div class="row">
                    <span class="label">{{ __('admin::app.quotes.quote-date') }} -</span>
                    <span class="value">{{ $quote->created_at->format('d-m-Y') }}</span>
                </div>

                <div class="row">
                    <span class="label">{{ __('admin::app.quotes.is_payment') }} -</span>
                    <span class="value">
                        @switch($quote->is_payment_completed)
                            @case(null)
                                    {{ __('admin::app.quotes.pending') }}
                                @break
                            @case(1)
                                    {{ __('admin::app.quotes.completed') }}
                                @break
                            @case(0)
                                    {{ __('admin::app.quotes.cancelled') }}
                                @break
                            @default
                                
                        @endswitch
                    </span>
                </div>

                <div class="table items">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('admin::app.quotes.name') }}</th>

                                <th>{{ __('admin::app.quotes.sales-person') }}</th>

                                <th>{{ __('admin::app.quotes.person') }}</th>

                                <th class="text-center">{{ __('admin::app.quotes.price') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>{{ $quote->name }}</td>

                                <td>
                                    {{ $quote->user->name }}
                                </td>

                                <td>
                                    {{ $quote->person->first_name }} {{ $quote->person->last_name }}
                                </td>

                                <td>{!! core()->formatBasePrice(($quote->price + $quote->tax + $quote->tip), true) !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </body>
</html>