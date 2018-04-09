@if (Session::has('flash_notification.message'))
    @if (Session::has('flash_notification.overlay'))
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')])
    @else
        <div class="alert alert-{{ Session::get('flash_notification.level') }} {{ Session::has('flash_notification.important')?'alert-important':'' }} alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>
                @if ("danger" == Session::get('flash_notification.level'))
                    <i class="icon fa fa-ban"></i>
                @elseif("success" == Session::get('flash_notification.level'))
                    <i class="icon fa fa-check"></i>
                @else
                    <i class="icon fa fa-{{ Session::get('flash_notification.level') }}"></i>
                @endif
                {{ ucwords(Session::get('flash_notification.level')) }}!</h4>
            {{ Session::get('flash_notification.message') }}
        </div>
        @if (Setting::get('app.flash_notification_auto_hide_enabled', true))
            <script>
                $(document).ready (function(){
                    $('div.alert').not('.alert-important').delay({{ Setting::get('app.flash_notification_auto_hide_delay', true) * 1000 }}).slideUp(200, function() {
                        $(this).alert('close');
                    });
                });
            </script>
        @endif
    @endif
    {{ Session::forget('flash_notification') }}
@endif
