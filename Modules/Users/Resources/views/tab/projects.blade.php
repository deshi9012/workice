<section class="panel panel-default">
    <div class="table-responsive">
        <table class="table table-striped" id="projects-table">
            <thead>
                <tr>
                    <th class="hide"></th>
                    <th>@langapp('title') </th>
                    <th class="col-date">@langapp('start_date') </th>
                    <th class="col-date">@langapp('due_date') </th>
                    <th>@langapp('sub_total') </th>
                    <th>@langapp('expenses') </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->assignments->where('assignable_type', Modules\Projects\Entities\Project::class) as $key => $project)
                <tr>
                    <td class="display-none">{{ $project->assignable->id }}</td>
                    <td>
                        <a href="{{ route('projects.view', ['id' => $project->assignable->id]) }}" class="text-ellipsis">
                            {{ $project->assignable->name }}
                        </a>
                    </td>
                    <td class="">{{ dateFormatted($project->assignable->start_date) }}</td>
                    <td class="">{{ dateFormatted($project->assignable->due_date) }}</td>
                    <td class="text-semibold">{{ formatCurrency($project->assignable->currency, $project->assignable->sub_total) }}</td>
                    <td class="text-semibold">{{ formatCurrency($project->assignable->currency, $project->assignable->total_expenses) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @push('pagestyle')
        @include('stacks.css.datatables')
    @endpush
    
    @push('pagescript')
        @include('stacks.js.datatables')
        <script>
        $(function () {
            var table = $('#projects-table').DataTable({
            processing: true,
                order: [
                    [0, "desc"]
                ],
            });
        });
        </script>
    @endpush
</section>