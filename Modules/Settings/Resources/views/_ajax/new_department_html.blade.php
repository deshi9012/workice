<li class="list-group-item" draggable="true" id="department-{{ $department->deptid }}">
                    <span class="pull-right">
                    <a href="{{ route('departments.edit', $department->deptid) }}" data-toggle="ajaxModal" data-dismiss="modal">
                            @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
                    </a>
                        <a href="#" class="deleteDepartment" data-department-id="{{ $department->deptid }}">
                            @icon('solid/times', 'icon-muted fa-fw')
                        </a>
                    </span>

                    <span class="pull-left media-xs">@icon('solid/arrows-alt', 'm-r-sm')</span>

                    <div class="clear">{{ $department->deptname }}</div>
                </li>