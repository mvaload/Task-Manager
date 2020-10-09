@php
    $formName = $options['formName'] ?? 'base';
@endphp
<div class="form-group">
    {{ Form::label($name, __("forms.labels.{$formName}.{$name}")) }}
    {{
        Form::text(
            $name,
            $value,
            ['class' => ($errors->has($name)) ? 'form-control is-invalid' : 'form-control'])
    }}
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
