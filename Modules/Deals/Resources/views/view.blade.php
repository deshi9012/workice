@extends('layouts.app')

@section('content')

<section id="content" class="bg">

            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">

                            <p class="h3">{{  $deal->title  }}

                                @can('deals_delete')

                                    <a href="{{  route('deals.delete', ['id' => $deal->id])  }}"
                                       class="btn btn-danger btn-sm pull-right" data-toggle="ajaxModal"
                                       data-rel="tooltip" data-placement="bottom" title="@langapp('delete')  ">@svg('solid/trash-alt')</a>

                                @endcan

                                @can('reminders_create')
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" href="{{  route('calendar.reminder', ['module' => 'deals', 'id' => $deal->id])  }}" title="@langapp('set_reminder')  ">
                        @icon('solid/clock')
                    </a>
                    @endcan

                                @can('deals_update')

                                    <a href="{{  route('deals.edit', ['id' => $deal->id])  }}"
                                       class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right"
                                       data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('edit')  " data-placement="bottom">
                                       @icon('solid/pencil-alt') @langapp('edit')  </a>

                                @endcan


                                @can('deals_update')

                                @if ($deal->status == 'open') 
                                        <a href="{{  route('deals.lost', ['id' => $deal->id])  }}"
                                           class="btn btn-danger btn-sm pull-right"
                                           data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('lost')  " data-placement="bottom">
                                           @icon('solid/times') @langapp('lost')  </a>

                                        <a href="{{ route('deals.win', $deal->id) }}" class="btn btn-success btn-sm pull-right" 
                                           data-rel="tooltip" data-toggle="ajaxModal" title="@langapp('close_deal')" data-placement="bottom">
                                           @icon('solid/check-circle') @langapp('won')  </a>

                                @endif

                                @if ($deal->status != 'open') 
                                        <a href="{{ route('deals.open', ['id' => $deal->id]) }}"
                                           class="btn btn-danger btn-sm pull-right"
                                           data-toggle="tooltip" title="@langapp('reopen')  "
                                           data-placement="bottom">@icon('solid/level-down-alt') @langapp('reopen')  </a>
                                @endif


                                    @endcan

                            </p>

    </div>
                    </div>
                </header>
                <section class="scrollable wrapper">


                    <div class="sub-tab m-b-10">
                        <ul class="nav pro-nav-tabs nav-tabs-dashed">


                            <li class="{{  ($tab == 'overview') ? 'active' : '' }}">
                                <a href="{{  route('deals.view', ['id' => $deal->id, 'tab' => 'overview'])  }}">@icon('solid/home') @langapp('overview')  </a>
                            </li>

                            <li class="{{  ($tab == 'calls') ? 'active' : ''  }}">
                                <a href="{{  route('deals.view', ['id' => $deal->id, 'tab' => 'calls'])  }}">@icon('solid/phone') @langapp('calls')  
                                </a>
                            </li>

                            <li class="{{  ($tab == 'emails') ? 'active' : ''  }}">
                                <a href="{{  route('deals.view', ['id' => $deal->id, 'tab' => 'emails'])  }}">@icon('solid/envelope-open') @langapp('emails')  
                                <span class="label bg-danger">{{ $deal->unreadMessages() ? $deal->unreadMessages() : '' }}</span>
                                </a>
                            </li>

                            <li class="{{  ($tab == 'activity') ? 'active' : ''  }}">
                                <a href="{{  route('deals.view', ['id' => $deal->id, 'tab' => 'activity'])  }}">
                                @icon('solid/history') @langapp('activity')
                                    {!! $deal->has_activity ? '<i class="fas fa-bell text-danger"></i>' : '' !!}
                                </a>
                            </li>

                            <li class="{{  ($tab == 'products') ? 'active' : ''  }}">
                                <a href="{{  route('deals.view', ['id' => $deal->id, 'tab' => 'products'])  }}">@icon('solid/shopping-cart') @langapp('products')</a>
                            </li>


                            <li class="{{  ($tab == 'files') ? 'active' : ''  }}">
                                <a href="{{  route('deals.view', ['id' => $deal->id, 'tab' => 'files'])  }}">@icon('solid/cloud-upload-alt') @langapp('files')  </a>
                            </li>
                            <li class="{{  ($tab == 'comments') ? 'active' : ''  }}">
                                @php $count = $deal->comments()->where('unread', 1)->count();  @endphp
                                <a href="{{  route('deals.view', ['id' => $deal->id, 'tab' => 'comments'])  }}">
                                    @icon('solid/comments') @langapp('comments')  
                                    {!!  ($count > 0) ? '<label class="label bg-success">'.$count.'</label>' : ''  !!}
                                </a>
                            </li>

                            <li class="{{  ($tab == 'calendar') ? 'active' : ''  }}">
                                <a href="{{  route('deals.view', ['id' => $deal->id, 'tab' => 'calendar'])  }}">@icon('solid/calendar-alt') @langapp('calendar')  </a>
                            </li>

                        </ul>
                    </div>


                        @include('deals::tab._'.$tab)




                </section>

    </section>
</section>

@push('pagescript')
    @include('stacks.js.markdown')
@endpush

@endsection