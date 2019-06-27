<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes') - <strong>{{ $contact->name }}</strong> </h4>
        </div>
        {!! Form::open(['route' => ['contacts.api.update', $contact->id], 'class' => 'bs-example form-horizontal ajaxifyForm validator', 'method' => 'PUT']) !!}
        <div class="modal-body">
            <input type="hidden" name="id" value="{{ $contact->id }}">
            <span id="status"></span>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('fullname') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $contact->name }}" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('username') @required</label>
                <div class="col-lg-8">
                    <input class="form-control" id='username' type="text" value="{{ $contact->username }}" name="username" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('password')</label>
                <div class="col-lg-8">
                    <input class="form-control" type="password" placeholder="Leave blank" name="password">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('email') @required</label>
                <div class="col-lg-8">
                    <input class="form-control" id='email' type="email" value="{{ $contact->email }}" name="email" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('job_title')</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" value="{{ $contact->profile->job_title }}" name="job_title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('company')</label>
                <div class="col-lg-8">
                    <select class="form-control select2-option" name="company">
                                    @foreach (Modules\Clients\Entities\Client::select('id', 'name')->get() as $company)
                                        <option value="{{  $company->id  }}" {{  $contact->profile->company == $company->id ? ' selected="selected"' : ''  }}>
                                            {{  $company->name  }}
                                        </option>
                                    @endforeach
                            </select>

                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('phone') </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="phone" value="{{ $contact->profile->phone }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('city') </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="city" value="{{ $contact->profile->city }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('country') </label>
                <div class="col-lg-8">
                    <select class="form-control select2-option" name="country">
                                @foreach (countries() as $country)
                                    <option value="{{ $country['name'] }}" {{ $country['name'] == $contact->profile->country ? 'selected' : '' }}>
                                        {{ $country['name'] }}
                                    </option>
                                @endforeach

                            </select>
                </div>
            </div>

            
            
            <div class="modal-footer">
                {!! closeModalButton() !!}
                {!! renderAjaxButton() !!}
                
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@push('pagestyle')
    @include('stacks.css.form')
@endpush
    
@push('pagescript')
    @include('stacks.js.form')
    @include('partial.ajaxify')
@endpush

@stack('pagestyle')
@stack('pagescript')
