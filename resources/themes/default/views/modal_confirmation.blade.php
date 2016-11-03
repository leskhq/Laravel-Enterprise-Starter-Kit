<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{ $modal_title }}</h4>
</div>
<div class="modal-body">
    @if($error)
        <div>{{{ $error }}}</div>
    @else
        {!! $modal_body !!}
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('general.button.cancel') }}</button>
    @if(!$error)
        <a href="{{ $modal_route }}" type="button" class="btn btn-primary">{{ trans('general.button.ok') }}</a>
    @endif
</div>
