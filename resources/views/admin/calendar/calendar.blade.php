@extends('layouts.admin')
@section('content')
    <div>
        <div class="container mt-4">
            <div class="row">
                <!-- Box for Red -->
                <div class="col-md-4">
                    <div class="alert alert-danger" role="alert">
                        <strong>Red:</strong> Event is refused.
                    </div>
                </div>

                <!-- Box for Green -->
                <div class="col-md-4">
                    <div class="alert alert-success" role="alert">
                        <strong>Green:</strong> Event is approved.
                    </div>
                </div>

                <!-- Box for Blue -->
                <div class="col-md-4">
                    <div class="alert alert-primary" role="alert">
                        <strong>Blue:</strong> Event is in progress.
                    </div>
                </div>
            </div>
        </div>

    </div>
@can('event_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.events.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<h3 class="page-title">{{ trans('global.systemCalendar') }}</h3>
<div class="card">
    <div class="card-header">
        {{ trans('global.systemCalendar') }}
    </div>

    <div class="card-body">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

        <div id='calendar'></div>


    </div>
</div>
@endsection

@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: events,
                eventRender: function (event, element) {
                    // Customize the appearance based on the event state
                    if (event.state === 0) {
                        element.css('background-color', 'red');
                    } else if (event.state === 1) {
                        element.css('background-color', 'green');
                    } else if (event.state === 2) {
                        element.css('background-color', 'blue');
                    }
                },



            })
        });
</script>
@stop
