<div class="container">

    <div class="row align-items-start">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Nombres</label>
                <input readonly="readonly" class="form-control" value="{{ $user->name }}">
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

    <div class="row align-items-start">
        <div class="col-md-6">
            <div class="mb-6">
                @php
                $index = [
                    'link' => route('users.index'),
                    'dashboard_title' => 'Personal'
                ];
                @endphp
                <button onclick="loadContent({{ json_encode( $index ) }})" type="button" class="btn btn-primary">Ir al listado de personas</button>
            </div>
        </div>
    </div>


</div>
