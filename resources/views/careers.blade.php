<x-layout>
    <div class="container p-5 blue-body text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                Trabaja con nosotros
            </h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center align-items-center border rounded p-2 shadow">
            <div class="col-12 col-md-6">
                <h2>Trabaja como administrador</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <h2>Trabaja como revisor</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <h2>Trabaja como redactor</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="col-12 col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="p-5" action="{{ route('careers.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="role" class="form-label">¿Por qué rol estás haciendo la candidatura?</label>
                        <select name="role" id="role" class="form-control">
                            <option value=""></option>
                            <option value="admin">Administrador</option>
                            <option value="revisor">Revisor</option>
                            <option value="writer">Redactor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') ?? Auth::user()->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Háblanos de ti</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
                    </div>
                    <div class="mt-2 text-center">
                        <button class="btn cool-blue text-white ">Enviar candidatura</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>












































































