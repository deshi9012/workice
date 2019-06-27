<section class="panel panel-default">
    <div class="table-responsive">
        <table class="table table-striped" id="deals-table">
            <thead>
                <tr>
                    <th class="hide"></th>
                    <th>@langapp('title') </th>
                    <th>@langapp('pipeline') </th>
                    <th class="">@langapp('stage') </th>
                    <th class="">@langapp('deal_value') </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->deals as $key => $deal)
                <tr>
                    <td class="display-none">{{ $deal->id }}</td>
                    <td>
                        <a href="{{ route('deals.view', ['id' => $deal->id]) }}">{{ $deal->title }}</a>
                    </td>
                    <td class="text-dark">{{ $deal->pipe->name }}</td>
                    <td class="">{{ optional($deal->category)->name }}</td>
                    <td><strong>{{ $deal->computed_value }}</strong></td>
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
    var table = $('#deals-table').DataTable({
        processing: true,
        order: [
            [0, "desc"]
        ],
    });
    });
    </script>
    @endpush
</section>