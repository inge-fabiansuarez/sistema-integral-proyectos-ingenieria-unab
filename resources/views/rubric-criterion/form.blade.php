<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('rubrics_name', 'Nombre de la Rubrica') }}
            {{ Form::text('rubrics_name', $rubricCriterion->rubric->name, ['class' => 'form-control', 'readonly' => 'readonly']) }}
            {!! $errors->first('rubrics_id', '<div class="invalid-feedback">:message</div>') !!}
            <input type="hidden" name="rubrics_id" value="{{ $rubricCriterion->rubrics_id }}">
        </div>
        <div class="form-group">
            {{ Form::label('name', 'Nombre') }}
            {{ Form::text('name', $rubricCriterion->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
