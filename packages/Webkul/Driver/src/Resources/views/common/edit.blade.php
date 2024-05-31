@extends('admin::layouts.master')

@section('page_title')
    {{ __('drivers::app.common.edit.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('drivers.edit.header.before', ['driver' => $driver]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('drivers.edit', $driver) }}

            <div class="page-title">
                <h1>{{ __('drivers::app.common.edit.title') }}</h1>
            </div>
        </div>

        {!! view_render_event('drivers.edit.header.after', ['driver' => $driver]) !!}

        <form 
            method="POST" 
            action="{{ route('drivers.information.update', $driver->id) }}"
            @submit.prevent="onSubmit" 
            enctype="multipart/form-data"
        >

            <div class="page-content">
                <div class="form-container">

                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('drivers.edit.form_buttons.before', ['driver' => $driver]) !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('drivers::app.common.edit.save-btn-title') }}
                            </button>

                            <a href="{{ route('drivers.information.index') }}">{{ __('drivers::app.common.edit.back') }}</a>

                            {!! view_render_event('drivers.edit.form_buttons.after', ['driver' => $driver]) !!}
                        </div>
        
                        <div class="panel-body">
                            {!! view_render_event('drivers.edit.form_controls.before', ['driver' => $driver]) !!}

                            @csrf()

                            <input name="_method" type="hidden" value="PUT">
                
                            @include('admin::common.custom-attributes.edit', [
                                'customAttributes' => app('Webkul\Attribute\Repositories\AttributeRepository')->findWhere([
                                    'entity_type'     => 'drivers',
                                    'is_user_defined' => 0,
                                
                                ]),
                                'entity'           => $driver,
                            ])

                            {!! view_render_event('drivers.edit.form_controls.after', ['driver' => $driver]) !!}

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop