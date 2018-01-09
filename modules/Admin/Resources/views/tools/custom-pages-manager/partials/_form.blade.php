<div class="form-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group col-md-6">
                <label name="name" class="control-label col-lg-3 col-xs-12">Internal Name
                    <span class="required" aria-required="true"></span>
                </label>
                <div class="col-lg-12 col-xs-12">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label name="title" class="control-label col-lg-3 col-xs-12">Page Title
                    <span class="required" aria-required="true"></span>
                </label>
                <div class="col-lg-12 col-xs-12">
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    <span class="help-block title-error-block"></span>
                </div>
            </div>
            
            <div class="form-group col-md-12">
                <label name="route" class="col-xs-12 text-center">Page Route</label>
                <div class="input-group col-md-8 col-md-offset-2">
                  <span class="input-group-addon" id="basic-addon3">{{ config('app.url') }}</span>
                  {!! Form::text('route', null, ['class' => 'form-control', 'aria-describedby' => 'basic-addon3']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label name="description" class="col-lg-3 col-xs-12">Description</label>
                <div class="col-lg-12 col-xs-12">
                    {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                    <span class="help-block description-error-block"></span>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label name="keywords" class="col-lg-3 col-xs-12">Keywords</label>
                <div class="col-lg-12 col-xs-12">
                    {{ Form::textarea('keywords', null, ['class' => 'form-control']) }}
                    <span class="help-block keywords-error-block"></span>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label name="template_id" class="control-label col-lg-3 col-xs-12">Template
                    <span class="required" aria-required="true"></span>
                </label>
                <div class="col-lg-12 col-xs-12">
                    {{ Form::select('template_id', $templates, null, ['class' => 'form-control selectpicker']) }}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label name="is_active" class="col-lg-3 col-xs-12">Active</label>
                <div class="col-lg-12 col-xs-12">
                    {{ Form::select('is_active', ['0' => 'No', '1' => 'Yes'], null, ['class' => 'form-control selectpicker']) }}
                    <span class="help-block is_active-error-block"></span>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label name="logo_title" class="col-lg-3 col-xs-12">Image Title</label>
                <div class="col-lg-12 col-xs-12">
                    {!! Form::text('logo_title', null, ['class' => 'form-control']) !!}
                    <span class="help-block logo_title-error-block"></span>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label name="logo_link" class="col-lg-3 col-xs-12">Image Link</label>
                <div class="col-lg-12 col-xs-12">
                    {!! Form::text('logo_link', null, ['class' => 'form-control']) !!}
                    <span class="help-block logo_link-error-block"></span>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label name="logo_slogan" class="col-lg-3 col-xs-12">Image Slogan</label>
                <div class="col-lg-12 col-xs-12">
                    {{ Form::textarea('logo_slogan', null, ['class' => 'form-control']) }}
                    <span class="help-block logo_slogan-error-block"></span>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label name="logo_description" class="col-lg-3 col-xs-12">Image Description</label>
                <div class="col-lg-12 col-xs-12">
                    {{ Form::textarea('logo_description', null, ['class' => 'form-control']) }}
                    <span class="help-block logo_description-error-block"></span>
                </div>
            </div>

            @if(isset($customPage) && $customPage->logo_image != '')
                <div class="form-group col-md-6" >
                    <div class="fileinput fileinput-exists" data-provides="fileinput">
                        
                        <div class="fileinput-new thumbnail" style="width: 400px; height: 250px;">
                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" style="width: 400px; height: 250px;"/>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="width: 400px; height: 250px;">
                            <img src="{{ $customPage->customPageLogoImagePath() }}">
                        </div>
                        <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="logo_image">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group col-md-6">
                    <label name="logo_image" class="col-lg-3 col-xs-12">Image Upload</label>
                    <div class="col-lg-12 col-xs-12">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 400px; height: 250px;">
                                <img src="http://www.placehold.it/400x250/EFEFEF/AAAAAA&text=no+image" />
                            </div>
                            <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="logo_image"></span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div> 
            @endif

            
            <div class="form-group col-md-12 ">
                <label name="logo_image" class="control-label col-lg-3 col-xs-12">Page Content
                    <span class="required" aria-required="true"></span>
                </label>
                <div class="col-lg-12 col-xs-12">
                    {{ Form::textarea('content', null, ['class' => 'form-control']) }}
                    <span class="help-block content-error-block"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 50px;">
        <div class="ibox-footer">
            <button type="submit" class="btn btn-success pull-left">{{ $button_label }}</button>
        </div>
    </div>
</div>