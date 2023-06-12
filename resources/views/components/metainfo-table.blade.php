<table class="table table-striped table-hover border">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre tag</th>
            <th scope="col">Cantidad de artículos relacionados</th>
            <th scope="col">Actualizar</th>
            <th scope="col">Cancelar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($metaInfos as $metaInfo)
        <tr>
            <th scope="row">{{ $metaInfo->id }}</th>
            <td>{{ $metaInfo->name }}</td>
            <td>{{ count($metaInfo->articles) }}</td>
            @if ($metaType === "tags")
            <td>
                <form action="{{ route('admin.editTag', ['tag' => $metaInfo]) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="text" name="name" placeholder="Nuevo nombre tag" class="form-control w-50 d-inline">
                    <button type="submit" class="btn cool-blue text-white">Actualizar</button>
                </form>
            </td>
            <td>
                <form action="{{ route('admin.deleteTag', ['tag' => $metaInfo]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger text-white">Eliminar</button>
                </form>
            </td>
            @else
            <td>
                <form action="{{ route('admin.editCategory', ['category' => $metaInfo]) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="text" name="name" placeholder="Nuevo nombre categoria" class="form-control w-50 d-inline">
                    <button type="submit" class="btn cool-blue text-white">Actualizar</button>
                </form>
            </td>
            <td>
                <form action="{{ route('admin.deleteCategory', ['category' => $metaInfo]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger text-white">Eliminar</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>