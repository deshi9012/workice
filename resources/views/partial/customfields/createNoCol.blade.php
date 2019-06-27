@foreach ($fields as $field)
                        @php 
                        $options = $field->field_options;  
                        @endphp

                        @if ($field->type == 'dropdown')

                            <div class="form-group">
                                <label>{{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>
                                <select class="form-control"
                                        name="{{  'custom['.$field->name.']'  }}" {{  ($field->required) ? 'required' : '' }} >
                                    @foreach ($options['options'] as $opt) 
                                        <option value="{{  $opt['label']  }}" {{  ($opt['checked']) ? 'selected="selected"' : '' }}>{{  $opt['label']  }}</option>
                                    @endforeach
                                </select>
                            <span class="help-block">
                                {{  isset($options['description']) ? $options['description'] : ''  }}
                            </span>

                            </div>

                        @elseif ($field->type == 'text')

                            <div class="form-group">
                                <label>{{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>
                                <input type="text" name="{{  'custom['.$field->name.']'  }}" class="input-sm form-control" {{  ($field->required) ? 'required' : '' }}>
                                <span class="help-block">
                                 {{  isset($options['description']) ? $options['description'] : ''  }}
                                </span>
                            </div>

                            
                        @elseif ($field->type == 'paragraph')

                            <div class="form-group">
                                <label>{{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>
                                <textarea name="{{ 'custom['.$field->name.']'  }}" class="form-control ta" {{  ($field->required) ? 'required' : '' }}></textarea>
                                <span class="help-block">
                                    {{ isset($options['description']) ? $options['description'] : ''  }}
                                </span>
                            </div>

                            
                        @elseif ($field->type == 'radio')


                            <div class="form-group">
                                <label>{{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>
                                @foreach ($options['options'] as $opt) 
                                    <div class="form-radio">
                                        <label class="">
                                            <input type="radio"
                                                   name="{{  'custom['.$field->name.']'  }}" {{  ($opt['checked']) ? 'checked' : '' }}
                                                   value="{{  $opt['label']  }}" >
                                             <span class="label-text">{{  $opt['label']  }}</span>
                                        </label>
                                    </div>
                                @endforeach
                                <span class="help-block">
                                    {{  isset($options['description']) ? $options['description'] : ''  }}
                                </span>
                            </div>

                            
                        @elseif ($field->type == 'checkboxes')
                            <div class="form-group">
                                <label>{{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>

                                @foreach ($options['options'] as $opt)
                                <div class="form-check">
                                        <label class="">
                                            <input type="checkbox"
                                                   name="{{  'custom['.$field->name.']'  }}[]" {{  ($opt['checked']) ? 'checked' : '' }}
                                                   value="{{  $opt['label']  }}">
                                            
                                            <span class="label-text">{{  $opt['label']  }}</span>

                                        </label>
                                </div>
                                @endforeach
                                <span class="help-block">
                                    {{  isset($options['description']) ? $options['description'] : ''  }}
                                </span>

                            </div>
                            <!-- Email Field -->
                        @elseif ($field->type == 'email')

                            <div class="form-group">
                                <label>{{  $field->label  }} {!!  ($field->required) ? '<abbr title="required">*</abbr>' : '' !!}</label>
                                <input type="email" name="{{  'custom['.$field->name.']'  }}" class="input-sm form-control" {{  ($field->required) ? 'required' : '' }}>
                                <span class="help-block">
                                    {{  isset($options['description']) ? $options['description'] : ''  }}
                                </span>
                            </div>

                        @elseif ($field->type == 'section_break')
                            <hr/>
                        @endif


                    @endforeach
                