<div class="row align-items-center my-2">
  <div class="col-md-{{ $col1 ?? 4 }}">
    <label>{{ $label }}</label>
  </div>
  <div class="col-md-{{ $col2 ?? 6 }}">
    <input type="{{ $type ?? 'text' }}" onchange="{{ $onchange ?? '' }}" class="form-control" name="{{ $name }}" value="{{ $value ?? '' }}" placeholder="{{ $placeholder ?? '' }}" {{ $required ?? "" }} {{ $readonly ?? "" }}>
    <div></div>
  </div>
</div>