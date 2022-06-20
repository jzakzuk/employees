
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
    <h4 class="h2" id="dashboard-option-title">
        <input value="{{ request()->input('search') }}" onkeyup="searchIndex(this, '{{ route('users.index') }}')"  id="index_search_input" type="text" class="form-control" placeholder="Enter para buscar">
    </h4>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        @php
            $create = [
                'link' => route('users.create'),
                'dashboard_title' => 'Crear'
            ];
        @endphp
        <button onclick="loadContent({{ json_encode($create) }})" type="button" class="btn btn-sm btn-primary">Crear</button>
      </div>
    </div>
  </div>

<div class="table-responsive">

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Identificación</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->identification }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ @$user->city->name }}</td>
                <td>
                    @php
                        $edit = [
                            'link' => route('users.edit', $user->id),
                            'dashboard_title' => 'Editar: '.$user->name
                        ]; 
                        $view = [
                            'link' => route('users.view', $user->id),
                            'dashboard_title' => 'Detalles de: '.$user->name
                        ]; 
                    @endphp
                    <button onclick="loadContent({{ json_encode($view) }})" type="button" class="btn btn-primary btn-sm">Ver</button>
                    <button onclick="loadContent({{ json_encode($edit) }})" type="button" class="btn btn-info btn-sm">Editar</button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Borrar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">
                    {{  $users->appends(request()->input())->links('pagination::bootstrap-4') }}
                </td>
            </tr>
            
        </tfoot>
       
    </table>

</div>
  
<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Eliminar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        ¿Eliminar usuario?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Confirmar</button>
    </div>
    </div>
</div>
</div>