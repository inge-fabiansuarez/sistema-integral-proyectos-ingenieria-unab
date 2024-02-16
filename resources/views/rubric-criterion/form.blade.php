<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', 'Nombre') }}
            {{ Form::text('name', $rubricCriterion->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('rubrics_id', 'ID de Rúbrica') }}
            {{ Form::text('rubrics_id', $rubricCriterion->rubrics_id, ['class' => 'form-control' . ($errors->has('rubrics_id') ? ' is-invalid' : ''), 'placeholder' => 'ID de Rúbrica']) }}
            {!! $errors->first('rubrics_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
