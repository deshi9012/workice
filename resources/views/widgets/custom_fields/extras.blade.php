<div class="line"></div>
<small class="text-uc text-xs text-muted">@langapp('custom_fields')</small>
<ul class="no-style p-l-5">
@foreach ($custom as $key => $f)
@if (App\Entities\CustomField::where(['name' => $f->meta_key])->count() > 0)
<li class="m-xs">
    <span class="text-muted">@icon('solid/dot-circle')
    {{  ucfirst(humanize($f->meta_key, '-'))  }}:</span> {{  isJson($f->meta_value) ? implode(', ', json_decode($f->meta_value)) : $f->meta_value  }}
</li>
@endif
@endforeach
</ul>