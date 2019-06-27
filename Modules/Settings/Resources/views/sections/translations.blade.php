<section class="panel panel-default">
        <header class="panel-heading padder-v">
                @icon('solid/language') @langapp('translations')

                

                <a data-rel="tooltip" data-toggle="ajaxModal" data-original-title="Restore Translations" class="btn btn-sm btn-warning pull-right" data-placement="left"
                               href="{{ route('translations.upload') }}">
                           Restore
                            </a>
                <a data-rel="tooltip" data-original-title="Backup Translations" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-placement="left"
                               href="{{ route('translations.download') }}">
                           Backup
                            </a>
                <a data-rel="tooltip" data-toggle="ajaxModal" data-original-title="New Language" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-placement="left"
                               href="{{ route('languages.create') }}">@icon('solid/plus') @langapp('create')
                </a>
                            
            </header>
        <div class="table-responsive">
            <table id="table-translations" class="table table-striped language-list">
                <thead>
                <tr>
                    <th>@langapp('language')</th>
                    <th>@langapp('progress')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach (App\Entities\Language::all() as $l)
                <tr id="language-{{ $l->id }}">
                        <td class="">{{  ucwords(str_replace('_', ' ', $l->name))  }}</td>
                        <td>
                            <?php $bar = 'danger';
                            if ($l->progress > 20) {
                                $bar = 'warning';
                            }
                            if ($l->progress > 50) {
                                $bar = 'info';
                            }
                            if ($l->progress > 80) {
                                $bar = 'success';
                            } ?>
                            <div class="progress progress-sm">
                                <div class="progress-bar progress-bar-{{ $bar }}" role="progressbar" aria-valuenow="{{ $l->progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $l->progress }}%;">
                                    {{ $l->progress }}%
                                </div>
                            </div>
                        </td>
                        <td class="text-right">
                            
                            <a data-rel="tooltip"
                               data-original-title="{{ ($l->active == 1 ? langapp('deactivate') : langapp('activate'))  }}"
                               class="active-translation btn btn-xs btn-{{  ($l->active == 0 ? 'default' : 'success')  }}" data-href="{{  route('translations.status', ['name' => $l->code])  }}">
                               @icon('solid/eye')
                           </a>
                            <a data-rel="tooltip" data-original-title="@langapp('edit')" class="btn btn-xs btn-default"
                               href="{{  route('translations.view', $l->code)  }}">
                           @icon('solid/pencil-alt')
                            </a>
                            <a href="#" class="btn btn-xs btn-default deleteComment" data-language-id="{{$l->id}}" title="@langapp('delete')">
                                @icon('solid/trash-alt')
                            </a>
                            
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </section>

@push('pagestyle')
@include('stacks.css.form')
@endpush

@push('pagescript')
@include('stacks.js.form')
@include('stacks.js.activate_lang')
<script>
    $('.language-list').on('click', '.deleteComment', function (e) {
            e.preventDefault();
            var tag, id;

            tag = $(this);
            id = tag.data('language-id');

            if(!confirm('Do you want to delete this message?')) {
                return false;
            }
            axios.post('{{ route('languages.delete') }}', {
                id: id
            })
            .then(function (response) {
                    toastr.warning( response.data.message , '@langapp('response_status') ');
                    $('#language-' + id).hide(500, function () {
                        $(this).remove();
                    });
            })
            .catch(function (error) {
                toastr.error( 'Oop! Something went wrong!' , '@langapp('response_status') ');
        }); 

        });
</script>
@endpush
