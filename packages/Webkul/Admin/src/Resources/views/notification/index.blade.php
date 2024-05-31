@extends('admin::layouts.master')

@section('page_title')
    @lang('admin::app.notification.title')
@stop

@section('content-wrapper')

    @push('css')
        <style>
            .tabs {
            height: inherit;
            }
        </style>
    @endpush
    
    <div class="panel">
        <div class="panel-body">
            <tabs>
                <tab name="All" :selected="true">
                    @foreach($notifications as $notification)
                        @switch($notification['type'])
                            @case('Webkul\Admin\Notifications\Lead\LeadNotification')
                                @php $route = route('admin.leads.view',['id' => $notification['data']['id']]); @endphp
                                @break

                            @default
                                @php $route = ''; @endphp
                        @endswitch
                
                    <div class="div-seperator"></div>

                    <a href="{{ $route }}">
                        <div class="notif-title">
                            {{ $notification['data']['title'] }}
                        </div>
                    
                        <div class="notif-content">
                            {{ $notification['data']['content'] }} at {{ core()->formatDate($notification['created_at'], 'Y/m/d H:i')}}
                        </div>
                    </a>
                    @endforeach
                </tab>

                <tab name="Leads">
                    @foreach($notifications as $notification) 
                        <div class="div-seperator"></div>
                        
                        <a href="{{ route('admin.leads.view',['id' => $notification['data']['id']]) }}">
                            <div class="notif-title">
                                {{ $notification['data']['title'] }}
                            </div>
                            
                            <div class="notif-content">
                                {{ $notification['data']['content'] }} at {{ core()->formatDate($notification['created_at'], 'Y/m/d H:i')}}
                            </div>
                        </a>
                    @endforeach
                </tab>
            </tabs>
        </div>
    </div>
@stop
