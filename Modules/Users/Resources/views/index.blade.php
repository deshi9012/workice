@extends('layouts.app')

@section('content')

<section id="content" class="bg">
    <section class="hbox stretch">

            <section class="vbox">

                <header class="header panel-heading bg-white b-b b-light">

                    @admin
                        <a href="{{  route('users.export')  }}" class="btn btn-sm btn-{{ get_option('theme_color')  }} pull-right" data-rel="tooltip" title="@langapp('export') CSV">
                           @icon('solid/download') CSV
                       </a>
                        @endadmin

                        @can('users_create')
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-{{ get_option('theme_color')  }} pull-right" data-toggle="ajaxModal">
                           @icon('solid/plus') @langapp('create')
                       </a>
                        @endcan

                        @if(isAdmin() || can('announcements_create'))
                        <a href="{{ route('announcements.index') }}" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-rel="tooltip" title="@langapp('announcements')" data-placement="bottom">
                            @icon('solid/bullhorn') @langapp('announcements')
                        </a>
                        @endif

                <div class="btn-group">
						<button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown"> @langapp('filter') 
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
                        @foreach(Role::get() as $role)
                        <li>
								<a href="{{ route('users.index', ['filter' => $role->name]) }}">
									{{ ucfirst($role->name) }}
								</a>
						</li>   
                        @endforeach
							<li>
								<a href="{{ route('users.index') }}">@langapp('all') </a>
							</li>

						</ul>
					</div>

                       

                        @can('roles_view_all')
                        <a href="{{  route('users.roles')  }}"
                           class="btn btn-sm btn-{{ get_option('theme_color')  }}">
                           @icon('solid/user-secret') @langapp('roles')  </a>

                           <a href="{{  route('users.perm')  }}"
                           class="btn btn-sm btn-{{ get_option('theme_color')  }}">
                           @icon('solid/shield-alt') @langapp('permissions')</a>

                        @endcan

                        

                        




                    </header>



                <section class="scrollable wrapper">



                    <section class="panel panel-default">


                        <form id="frm-user" method="POST">

                        <div class="table-responsive">

                            <table class="table table-striped" id="users-table">
                                <thead>
                                <tr>
                                    <th class="hide"></th>
                                    <th class="no-sort">
                                        <label>
                                            <input name="select_all" value="1" id="select-all" type="checkbox" />
                                            <span class="label-text"></span>
                                        </label>
                                    </th>
                                    <th class="">@langapp('name')  </th>
                                    <th class="">@langapp('email')  </th>
                                    <th class=" ">Role </th>
                                    <th class=" ">Desk </th>
                                    <th class="">@langapp('mobile')  </th>
                                    <th class="col-date">@langapp('date')  </th>
                                </tr>
                                </thead>

                            </table>

                        @can('users_delete')
                        <button type="submit" id="button" class="btn btn-sm btn-danger m-xs" value="bulk-delete">
                        <span data-rel="tooltip" title="Are you sure?" data-placement="right">@icon('solid/trash-alt') @langapp('delete')</span>
                        </button>
                        @endcan

                        </div>




                        </form>





                    </section>
                </section>




            </section>

    </section>

    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>

</section>


@push('pagestyle')
@include('stacks.css.datatables')
@endpush

@push('pagescript')

@include('stacks.js.datatables')

<script>
$(function() {
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('users.data') !!}',
            data: {
                "filter": '{{ $filter }}',
            }
        },
        order: [[ 0, "desc" ]],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'chk', name: 'chk', orderable: false, searchable: false, sortable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'role', name: 'role' },
            { data: 'desk', name: 'desk' },
            { data: 'mobile', name: 'profile.mobile' },
            { data: 'created_at', name: 'created_at' }
        ]
    });

    $("#frm-user button").click(function(ev){
    ev.preventDefault();
    if($(this).attr("value") == "bulk-delete"){
    var form = $("#frm-user").serialize();
    axios.post('{{ route('users.bulk.delete') }}', form)
        .then(function (response) {
            toastr.warning(response.data.message, '@langapp('response_status') ');
            window.location.href = response.data.redirect;
    })
    .catch(function (error) {
    var errors = error.response.data.errors;
    var errorsHtml= '';
    $.each( errors, function( key, value ) {
        errorsHtml += '<li>' + value[0] + '</li>';
    });
        toastr.error( errorsHtml , '@langapp('response_status') ');
    });
    }
    
    });

});
</script>
@endpush

@endsection
