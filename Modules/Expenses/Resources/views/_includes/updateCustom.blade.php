@foreach ($fields as $field)
                        @php 
                        $val = $expense->metaValue($field->name);
                        $options = $field->field_options;
                        @endphp

                        

                        @if ($field->type == 'dropdown')
                            <div class="form-group">
                                <label class="col-lg-4 control-label">{{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>
                                <div class="col-lg-8">
                                    <select class="form-control"
                                        name="{{ 'custom['.$field->name.']' }}" {{ ($field->required) ? 'required' : '' }} >
                                    
                                    @foreach ($options['options'] as $opt)
                                    
                                        <option value="{{ $opt['label'] }}" {{ ($opt['label'] == $val) ? 'selected="selected"' : '' }}>{{ $opt['label'] }}</option>
                                    @endforeach
                                </select>
                            
                                <span class="help-block">{{  isset($options['description']) ? $options['description'] : ''  }}</span>
                            </div>

                            </div>

                        @elseif ($field->type == 'text')

                            <div class="form-group">
                                <label class="col-lg-4 control-label">{{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="{{ 'custom['.$field->name.']' }}" class="input-sm form-control"
                                       value="{{ $val }}" {{ ($field->required) ? 'required' : '' }}>
                                    
                                    <span class="help-block">{{  isset($options['description']) ? $options['description'] : ''  }}</span>
                                    </div>
                            </div>

                        @elseif ($field->type == 'paragraph')

                            <div class="form-group">
                                <label class="col-lg-4 control-label">{{ $field->label }} {!! ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>
                                    <div class="col-lg-8">
                                        <textarea name="{{ 'custom['.$field->name.']' }}" class="form-control ta" {{ ($field->required) ? 'required' : '' }}>{{ $val }}</textarea>
                                        <span class="help-block">{{  isset($options['description']) ? $options['description'] : ''  }}</span>
                                    </div>
                            </div>

                        @elseif ($field->type == 'radio')
                            <div class="form-group">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-8">
                                {{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}
                                @foreach ($options['options'] as $opt) 
                                <div class="form-check text-muted m-t-xs">
                                <label>
                                
                                        <input type="radio" name="{{ 'custom['.$field->name.']' }}" {{ ($val == $opt['label']) ? 'checked' : '' }}
                                               value="{{ $opt['label'] }}" {{ ($field->required) ? 'required' : '' }}>  
                                    <span class="label-text">{{ $opt['label'] }}</span>

                                </label>
                            </div>
                                    
                                @endforeach
                                <span class="help-block">{{  isset($options['description']) ? $options['description'] : ''  }}</span>
                            </div>
                            </div>

                        @elseif ($field->type == 'checkboxes')
                            <div class="form-group">

                                <label class="col-lg-4 control-label"></label>

                                <div class="col-lg-8">

                                {{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}

                                
                            @foreach ($options['options'] as $opt)
                            <div class="form-check text-muted m-t-xs">
                                <label>
                                    @php 
                                    $sel_val = json_decode($val);
                                    @endphp

                                            @if (is_array($sel_val)) 
                                                <input type="checkbox"
                                                       name="{{ 'custom['.$field->name.']' }}[]" {{ ($opt['checked'] || in_array($opt['label'], $sel_val)) ? 'checked' : '' }}
                                                       value="{{ $opt['label'] }}">
                                            @else
                                                <input type="checkbox"
                                                       name="{{ 'custom['.$field->name.']' }}[]" {{ ($opt['checked']) ? 'checked' : '' }}
                                                       value="{{ $opt['label'] }}">
                                            @endif
                                            <span class="label-text">{{ $opt['label'] }}</span>
                                        </label>
                                    </div>
                                @endforeach
                                <span class="help-block">{{  isset($options['description']) ? $options['description'] : ''  }}</span>
                            </div>

                            </div>
                           
                        @elseif ($field->type == 'email')

                            <div class="form-group">
                                <label class="col-lg-4 control-label"></label>{{ $field->label }} {!! ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>
                                <div class="col-lg-8">
                                    <input type="email" name="{{ 'custom['.$field->name.']' }}" value="{{ $val }}" class="input-sm form-control" {{ ($field->required) ? 'required' : '' }}>
                                    <span class="help-block">{{  isset($options['description']) ? $options['description'] : ''  }}</span>
                                </div>
                            </div>

                        @elseif ($field->type == 'section_break')
                            <hr/>
                        @endif


                    @endforeach