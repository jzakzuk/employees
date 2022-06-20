<div class="container pb-xl">

    <form method="post" action="{{ route('users.store') }}" onsubmit="submitForm(this)">
            @csrf

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nombres</label>
                    <input name="name" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input name="lastname" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Cargos</label>
                        @foreach($roles as $key => $role)
                            <div class="p-2">
                                @php
                                    $not = $role->name == 'presidente' ? '' : 'not_president';
                                @endphp
                                <input onclick="checkRole('role_{{$role->id}}','{{$role->name}}')" name="roles[]" type="checkbox" value="{{ $role->id }}" id="role_{{ $role->id }}" class="{{$not}}">
                                <label onclick="checkRole('role_{{$role->id}}','{{$role->name}}')" for="role_{{$role->id}}">{{ ucfirst($role->name) }}</label>
                            </div>  
                        @endforeach
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Jefe</label>
                    <select name="user_id" class="form-control" id="user_id">
                        <option value="">Seleccione</option>
                        @foreach ($bosses as $boss)
                            <option value="{{ $boss->id }}">{{ $boss->name }} {{ $boss->lastname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Identificación</label>
                    <input name="identification" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input name="address" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input name="phone" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Ciudad</label>
                    <!--search inoput-->
                    <input name="city_id" type="hidden" id="city_id">
                    <input id="city_name" 
                           data-id="city_id"
                           autocomplete="off"
                           type="text"
                           class="form-control"
                           onkeyup="searchData(this)"
                           onclick="startSearch(this)"
                           onblur="stopSearch(this)"
                           data-list="city_list"
                           data-loading="city_loading"
                           data-url="{{route('cities.search')}}"
                    >
                    <!--search loading-->
                    <!--<div id="city_loading" class="d-flex justify-content-center p-3 border border-1">
                        <div class="spinner-border" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>-->
                    <!--search list-->
                    <div  id="city_list" class="border border-1" style="display:none;max-height:200px;min-height:50px;overflow-y:scroll"></div>
                    
                </div>
            </div>
        </div>

        <div class="row align-items-start pb-4 mb-4">
            <div class="col-md-6">
                <div class="mb-6">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>

    </form>

</div>
