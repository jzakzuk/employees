<div class="container">

    <div class="row">

            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombres</label>
                        <input readonly="readonly" class="form-control" value="{{ $user->name }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="float-end">
                        @php
                            $index = [
                                'link' => route('users.index'),
                                'dashboard_title' => 'Personal'
                            ];
                            $edit = [
                                'link' => route('users.edit', $user->id),
                                'dashboard_title' => 'Editar: '.$user->name
                            ]; 
                        @endphp
                        <button onclick="loadContent({{ json_encode( $index ) }})" type="button" class="btn btn-success">Regresar al listado</button>
                        <button onclick="loadContent({{ json_encode($edit) }})" class="btn btn-info">Editar</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Borrar</button>
                    </div>      
                </div>

            </div>
        
            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Apellidos</label>
                        <input readonly="readonly" class="form-control" value="{{ $user->lastname }}">
                    </div>
                </div>
            </div>
        
            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Cargos</label><br>
                        @foreach ($user->roles as $role)
                            * <span>{{ ucfirst($role->name) }}</span><br>
                        @endforeach  
                    </div>
                </div>
            </div>
        
            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Jefe</label>
                        <input readonly="readonly" class="form-control" value="{{ @$user->boss->name }} {{ @$user->boss->lastname }}">
                    </div>
                </div>
            </div>
        
            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Identificación</label>
                        <input readonly="readonly" class="form-control" value="{{ $user->identification }}">
                    </div>
                </div>
            </div>
        
            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input readonly="readonly" class="form-control" value="{{ $user->address }}">
                    </div>
                </div>
            </div>
        
            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tléfono</label>
                        <input readonly="readonly" class="form-control" value="{{ $user->phone }}">
                    </div>
                </div>
            </div>
        
            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Ciudad</label>
                        <input readonly="readonly" class="form-control" value="{{ @$user->city->name }}">
                    </div>
                </div>
            </div>

    </div>

    <div class="row">

        <div class="col-md-12 mt-4" id="view_vollaborators">
        </div>

    </div>

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
            <button onclick="deleteUser('{{ route('users.delete', $user->id) }}', '{{ route('users.index') }}')" data-bs-dismiss="modal" type="button" class="btn btn-primary">Confirmar</button>
        </div>
        </div>
    </div>
    </div>
