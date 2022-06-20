<div class="container pb-xl">

    <form method="post" action="{{ route('users.update', $user->id) }}" onsubmit="submitForm(this)">
            @csrf

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nombres</label>
                    <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input name="lastname" type="text" class="form-control"  value="{{ $user->lastname }}">
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
                                    $checked = $user->hasRole($role->name) ? 'checked="checked"' : '';
                                   // $checked = 'checked';
                                @endphp
                                <input {{ $checked  }} onclick="checkRole('role_{{$role->id}}','{{$role->name}}')" name="roles[]" type="checkbox" value="{{ $role->id }}" id="role_{{ $role->id }}" class="{{$not}}" @if( $user->hasRole('presidente') && $role->name != 'presidente') disabled @endif>
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
                    <select name="user_id" class="form-control" id="user_id" @if( $user->hasRole('presidente') ) disabled @endif>
                        <option value="">Seleccione</option>
                        @foreach ($bosses as $boss)
                          @php
                            $selected = $boss->id == $user->user_id ? 'selected' : '';
                         @endphp
                            <option value="{{ $boss->id }}" {{ $selected }}>{{ $boss->name }} {{ $boss->lastname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Identificación</label>
                    <input name="identification" type="text" class="form-control"  value="{{ $user->identification }}">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input name="address" type="text" class="form-control"  value="{{ $user->address }}">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input name="phone" type="text" class="form-control"  value="{{ $user->phone }}">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control"  value="{{ $user->email }}">
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Ciudad</label>
                    <!--search inoput-->
                    <input name="city_id" type="hidden" id="city_id"  value="{{ $user->city_id }}">
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
                           value="{{ @$user->city->name }} - {{ @$user->city->department->name }}"
                    >
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