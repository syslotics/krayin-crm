@extends('admin::layouts.master')

@section('page_title')
    {{ __('drivers::app.common.create.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('drivers.create.header.before') !!}

        <div class="page-header">

            {{ Breadcrumbs::render('drivers.create') }}

            <div class="page-title">
                <h1>{{ __('drivers::app.common.create.title') }}</h1>
            </div>
        </div>

        {!! view_render_event('drivers.create.header.after') !!}

        <form 
            method="POST" 
            action="{{ route('drivers.information.store') }}" 
            @submit.prevent="onSubmit" 
            enctype="multipart/form-data"
        >
            <div class="page-content">
                <div class="form-container">

                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('drivers.create.form_buttons.before') !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('drivers::app.common.create.save-btn-title') }}
                            </button>

                            <a href="{{ route('drivers.information.index') }}">{{ __('drivers::app.common.create.back') }}</a>

                            {!! view_render_event('drivers.create.form_buttons.after') !!}
                        </div>
        
                        <div class="panel-body">
                            {!! view_render_event('drivers.create.form_controls.before') !!}

                            @csrf()

                            @include('admin::common.custom-attributes.edit', [
                                'customAttributes' => app('Webkul\Attribute\Repositories\AttributeRepository')->findWhere([
                                    'entity_type'     => 'drivers',
                                    'is_user_defined' => 0,
                                ]),
                            ])

                            {!! view_render_event('drivers.create.form_controls.after') !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop