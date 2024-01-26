<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', 'Nombre') }}
            {{ Form::text('name', old('name', $event->name), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Contraseña') }}
            <div class="input-group">
                {{ Form::text('password', $event->password, ['id' => 'password', 'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña']) }}
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="form-group">
            {{ Form::label('opening_date', 'Fecha y Hora de Apertura') }}
            {{ Form::datetimeLocal('opening_date', old('opening_date', $event->opening_date), ['class' => 'form-control' . ($errors->has('opening_date') ? ' is-invalid' : '')]) }}
            {!! $errors->first('opening_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('closing_date', 'Fecha y Hora de Cierre') }}
            {{ Form::datetimeLocal('closing_date', old('closing_date', $event->closing_date), ['class' => 'form-control' . ($errors->has('closing_date') ? ' is-invalid' : '')]) }}
            {!! $errors->first('closing_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        @if ($event->exists && $event->img_cover)
            <div class="form-group">
                {{ Form::label('img_cover', 'Imagen de Portada Actual') }}
                <img src="{{ asset('storage/' . $event->img_cover) }}" alt="Imagen de Portada Actual"
                    class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
            </div>
        @endif

        <div class="form-group">
            {{ Form::label('img_cover', 'Nueva Imagen de Portada') }}
            {{ Form::file('img_cover', ['class' => 'form-control' . ($errors->has('img_cover_new') ? ' is-invalid' : ''), 'accept' => 'image/*']) }}
        </div>
        {!! $errors->first('img_cover', '<p style="color:red;">:message</p>') !!}


        <div class="form-group">
            {{ Form::label('description', 'Descripción') }}
            {{ Form::textarea('description', old('description', $event->description), ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('project_fields', 'Campos de Proyecto') }}
            {{ Form::select('project_fields[]', $projectFields, $selectedProjectFields, ['class' => 'form-control', 'multiple' => 'multiple']) }}
            {!! $errors->first('project_fields', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>



</div>
<div class="box-footer mt20">
    <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
</div>
</div>

@push('js')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>
@endpush
