<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('evento', 'Evento') }}
            {{ Form::text('evento', $event->name, ['class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => 'Evento']) }}
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Título') }}
            {{ Form::text('title', $project->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Título']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Descripción') }}
            {{ Form::text('description', $project->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
