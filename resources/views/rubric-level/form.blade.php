<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::text('name', '', ['class' => 'form-control form-control-sm' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::text('points', '', ['class' => 'form-control form-control-sm' . ($errors->has('points') ? ' is-invalid' : ''), 'placeholder' => 'Puntos']) }}
            {!! $errors->first('points', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <input type="hidden" name="rubric_criteria_id" value="{{ $criterion->id }}">
    </div>
    <button type="submit" class="btn btn-secondary btn-sm">Añadir</button>
</div>
