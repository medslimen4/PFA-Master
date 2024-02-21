@extends('layouts.admin')
@section('content')
@can('event_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.events.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
            </a>
        </div>
    </div>
@endcan
@can('event_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-warning" href="{{ route("admin.events.deleted") }}">
                {{ trans('global.export_all_deleted_events') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.recurrence') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.states') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                        <tr data-entry-id="{{ $event->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $event->id ?? '' }}
                            </td>
                            <td>
                                {{ $event->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Event::RECURRENCE_RADIO[$event->recurrence] ?? '' }}
                            </td>
                            <td>
                                {{ $event->event->name ?? '' }}
                            </td>
                            <td>
                                @if($event->states === 0)
                                    Event Refused
                                @elseif($event->states === 1)
                                    Event Approved
                                @elseif($event->states === 2)
                                    Event In Progress
                                @else
                                    Unknown State
                                @endif
                            </td>
                            <td>
                                @can('event_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.events.show', $event->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('event_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.events.edit', $event->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('event_delete')
                                    <form action="{{ route('admin.events.destroy', $event->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ $event->events_count || $event->event ? 'Do you want to delete future recurring events, too?' : trans('global.areYouSure') }}');" style="display: inline-block;"
                                    >
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                                    @if($event->states === 2 )
                                        <form action="{{ route('admin.events.approve', $event->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-xs btn-success">Approve</button>
                                        </form>
                                    @endif
                                    @if($event->states === 2)
                                        <form action="{{ route('admin.events.refuse', $event->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-xs btn-danger">Refuse</button>
                                        </form>
                                    @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.events.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  $('.datatable-Event:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
    $(document).ready(function () {
        // Check for the state_change parameter in the URL
        var stateChange = new URLSearchParams(window.location.search).get('state_change');

        if (stateChange) {
            alert(stateChange);
            // Optionally, remove the state_change parameter from the URL
            var url = new URL(window.location.href);
            url.searchParams.delete('state_change');
            history.replaceState(null, null, url.toString());
        }
    });
</script>
@endsection
