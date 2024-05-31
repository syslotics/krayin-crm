@extends('admin::layouts.master')

@section('page_title')
    {{ __('drivers::app.common.index.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('drivers.information.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('drivers.index.header.before') !!}

                    {{ Breadcrumbs::render('drivers') }}

                    {{ __('drivers::app.common.index.title') }}

                    {!! view_render_event('drivers.index.header.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('drivers.create'))
                <template v-slot:table-action>
                    <a 
                        href="{{ route('drivers.information.create') }}" 
                        class="btn btn-md btn-primary"
                    >
                        {{ __('drivers::app.common.index.create') }}
                    </a>
                </template>
            @endif
        <table-component>
    </div>
@stop
