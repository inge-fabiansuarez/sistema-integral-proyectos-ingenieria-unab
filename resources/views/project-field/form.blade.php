<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', __('Nombre')) }}
            {{ Form::text('name', $projectField->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('Nombre')]) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('type_field', __('Tipo de Campo')) }}
            {{ Form::select('type_field', \App\Enums\TypeFieldProjectEnum::toArray(), optional($projectField->type_field)->getId(), ['class' => 'form-control' . ($errors->has('type_field') ? ' is-invalid' : '')]) }}
            {!! $errors->first('type_field', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('order', __('Orden')) }}
            {{ Form::number('order', $projectField->order, ['class' => 'form-control' . ($errors->has('order') ? ' is-invalid' : ''), 'placeholder' => __('Orden')]) }}
            {!! $errors->first('order', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>

