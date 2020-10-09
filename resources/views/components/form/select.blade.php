@php
    $formName = $options['formName'] ?? 'base';
    $nameField = $options['nameField'] ?? 'name';
    $valueField = $options['valueField'] ?? 'id';
    $multiple = $options['multiple'] ?? '';
    $items = $values->pluck($nameField, $valueField);
    $placeholder = __("forms.placeholders.{$formName}.{$name}")
@endphp
<div class="form-group">
    {{ Form::label($name, __("forms.labels.{$formName}.{$name}")) }}
    {{
        Form::select(
            $multiple !== '' ? $name . '[]' : $name,
            $items,
            $value,
            ['class' => ($errors->has($name)) ? 'form-control is-invalid' : 'form-control', $multiple, 'placeholder' => $placeholder])
    }}
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
