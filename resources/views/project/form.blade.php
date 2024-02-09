<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('evento', 'Evento') }}
            {{ Form::text('evento', $event->name, ['class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => 'Evento']) }}
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Título Projecto') }}
            {{ Form::text('title', $project->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Título']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Resumen') }}
            {{ Form::textarea('description', $project->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripción', 'rows' => 3]) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('authors', 'Autores') }}
            <select class="form-control" multiple="multiple" name="authors[]" id="authorsSelect">
                <!-- Aquí puedes iterar sobre los autores disponibles -->
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
            {!! $errors->first(
                'authors',
                '<div style="color: #fd5c70; font-size: .875em;margin-top: 0.25rem;width: 100%;" class="">:message</div>',
            ) !!}
        </div>

        <input type="hidden" name="event" value="{{ $event->id }}">
        <div class="form-group">
            {{ Form::label('cover_image', 'Imagen de Portada') }}
            {{ Form::file('cover_image', ['class' => 'form-control' . ($errors->has('cover_image') ? ' is-invalid' : ''), 'accept' => 'image/*']) }}
            {!! $errors->first('cover_image', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        @foreach ($event->projectFields as $field)
            <div class="form-group">
                {{ Form::label($field->slug, $field->name) }}
                @switch(App\Enums\TypeFieldProjectEnum::from($field->type_field)->getId())
                    @case(App\Enums\TypeFieldProjectEnum::TEXT->getId())
                        {{ Form::textarea($field->slug, '', ['class' => 'form-control' . ($errors->has($field->name) ? ' is-invalid' : ''), 'placeholder' => $field->name, 'rows' => 3]) }}
                    @break

                    @case(App\Enums\TypeFieldProjectEnum::FILE->getId())
                        {{ Form::file($field->slug, ['class' => 'form-control' . ($errors->has($field->name) ? ' is-invalid' : '')]) }}
                    @break

                    @default
                @endswitch

                {!! $errors->first(
                    $field->slug,
                    '<div style="color: #fd5c70; font-size: .875em;margin-top: 0.25rem;width: 100%;" class="">:message</div>',
                ) !!}
            </div>
        @endforeach

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
