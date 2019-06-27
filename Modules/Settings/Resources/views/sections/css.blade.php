<div class="row">
    <div class="col-lg-12 custom-editor">
        @php $css = ''; @endphp
        @if(File::exists(storage_path('app/public/css/style.css')))
        @php $css = File::get(storage_path('app/public/css/style.css')); @endphp
        @endif
        <section class="panel panel-default">
        <header class="panel-heading">@icon('solid/cogs') Custom CSS - (/storage/app/public/css/style.css)</header>
        <div class="panel-body">
            @if (!is_writable(storage_path('app/public/css/style.css')))
            <p class="text-danger">File /storage/app/public/css/style.css is not writable</p>
            @endif
            <div id="editor">{{ $css }}</div>
            
            {!! Form::open(['route' => 'settings.custom.css', 'class' => 'bs-example form-horizontal', 'id' => 'css_form']) !!}
            
            <textarea id="css-area" class="display-none" name="custom_css"></textarea>
            
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
                <a id="saveeditor" class="btn btn-sm btn-{{ get_option('theme_color') }}">@langapp('make_changes')</a>
            
        </div>
    </section>
    
</div>
</div>
@push('pagescript')

<script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.4.1/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.4.1/ext-beautify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function () {
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/css");
    var textarea = document.querySelector("#css-area");
    editor.getSession().on("change", function () {
        textarea.innerHTML = editor.getSession().getValue();
    });
    $("#saveeditor").click(function () {
        $('#css-area').val(editor.getSession().getValue());
        $('#css_form').submit();
    });

});
</script>
@endpush