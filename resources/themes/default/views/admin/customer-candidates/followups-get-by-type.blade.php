@foreach($candidateFollowups as $cf)
  <tr>
      <td align="center">
        {!! Form::checkbox('chkUser[]', $cf->id); !!}
      </td>
      <td>{!! link_to_route('admin.customer-candidates.show', $cf->name, $cf->id) !!}</td>
      <td>{{ $cf->type }}</td>
      <td>{{ $cf->phone }}</td>
      <td>{{ $cf->address }}</td>
      <td>
        <a href="{!! route('admin.candidate-followups.confirm-delete', $cf->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
      </td>
  </tr>
@endforeach