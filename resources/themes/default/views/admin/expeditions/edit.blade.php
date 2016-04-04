@extends('layouts.master')

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('admin/expeditions/general.page.edit.section-title') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
          
          {!! Form::model($expedition, ['route' => ['admin.expeditions.update', $expedition->id], 'method' => 'PATCH', 'id' => 'form_edit_user'] ) !!}

          @include('partials.forms.expedition_form')

          <div class="form-group">
              {!! Form::submit( trans('general.button.update'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-edit'] ) !!}
              <a href="{!! route('admin.expeditions.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
          </div>

          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>

@endsection