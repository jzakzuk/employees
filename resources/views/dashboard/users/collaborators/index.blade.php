
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
    <h6 class="h2" id="dashboard-option-title">Colaboradores</h6>
    <div class="btn-toolbar mb-2 mb-md-0">
      {{-- <div class="btn-group me-2">
        <input value="{{ request()->input('search') }}" onkeyup="searchIndex(this, '{{ route('users.view.collaborators', $user->id) }}')" data-target="view_vollaborators" id="index_search_input" type="text" class="form-control" placeholder="Buscar colaborador">
      </div> --}}
    </div>
  </div>

<div class="table-responsive">

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>Cargos</th>
                {{--<th></th>--}}
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ @$user->role_list }}</td>
                {{--<td>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Quitar colaborador</button>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10">
                    {{  $users->appends(request()->input())->links('pagination::bootstrap-4') }}
                </td>
            </tr>
            
        </tfoot>
       
    </table>

</div>