<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $rubricLevel->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('points') }}
            {{ Form::text('points', $rubricLevel->points, ['class' => 'form-control' . ($errors->has('points') ? ' is-invalid' : ''), 'placeholder' => 'Points']) }}
            {!! $errors->first('points', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('rubric_criteria_id') }}
            {{ Form::text('rubric_criteria_id', $rubricLevel->rubric_criteria_id, ['class' => 'form-control' . ($errors->has('rubric_criteria_id') ? ' is-invalid' : ''), 'placeholder' => 'Rubric Criteria Id']) }}
            {!! $errors->first('rubric_criteria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>