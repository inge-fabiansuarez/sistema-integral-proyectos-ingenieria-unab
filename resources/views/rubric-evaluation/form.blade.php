<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('projects_id') }}
            {{ Form::text('projects_id', $rubricEvaluation->projects_id, ['class' => 'form-control' . ($errors->has('projects_id') ? ' is-invalid' : ''), 'placeholder' => 'Projects Id']) }}
            {!! $errors->first('projects_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('evaluador_id') }}
            {{ Form::text('evaluador_id', $rubricEvaluation->evaluador_id, ['class' => 'form-control' . ($errors->has('evaluador_id') ? ' is-invalid' : ''), 'placeholder' => 'Evaluador Id']) }}
            {!! $errors->first('evaluador_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('rubric_criteria_id') }}
            {{ Form::text('rubric_criteria_id', $rubricEvaluation->rubric_criteria_id, ['class' => 'form-control' . ($errors->has('rubric_criteria_id') ? ' is-invalid' : ''), 'placeholder' => 'Rubric Criteria Id']) }}
            {!! $errors->first('rubric_criteria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('rubric_levels_selected_id') }}
            {{ Form::text('rubric_levels_selected_id', $rubricEvaluation->rubric_levels_selected_id, ['class' => 'form-control' . ($errors->has('rubric_levels_selected_id') ? ' is-invalid' : ''), 'placeholder' => 'Rubric Levels Selected Id']) }}
            {!! $errors->first('rubric_levels_selected_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('comments') }}
            {{ Form::text('comments', $rubricEvaluation->comments, ['class' => 'form-control' . ($errors->has('comments') ? ' is-invalid' : ''), 'placeholder' => 'Comments']) }}
            {!! $errors->first('comments', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>