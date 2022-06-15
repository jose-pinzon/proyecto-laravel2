
@extends('layouts.app')
@section('nav')
    @include('includes.navAdmin')
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8">
@endsection
@section('content')
    <h1 class="text-2xl text-center mt-10">Actualizar vacates {{$vacante->titulo}}</h1>

    <form action="{{route('vacantes.update',['vacante' => $vacante->id])}}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto my-10">

        @csrf
        @method('PUT')
            <div class="mb-5">
                <label for="titulo" class="block text-gray-700 text-sm mb-2">Titulo:</label>
                <input id="titulo" type="text" class="p-3 bg-gray-100 rounded form-input w-full @error('titulo') is-invalid @enderror" name="titulo"
                value="{{$vacante->titulo}}"  autocomplete="titulo" autofocus placeholder="titulo de la vacante">

                @error('titulo')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                        <strong class="font-bold">Error</strong>
                        <span class="block">{{$message}} </span>
                    </div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="categoria" class="block text-gray-700 text-sm mb-2">Categoria:</label>
                <select name="categoria" id="categoria"
                class="block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100 w-full">
                    <option disabled selected >-Selecciona-</option>
                    @foreach ($categorias as $cate)
                        <option  {{ $vacante->categoria_id == $cate->id ? 'selected' : '' }} value="{{$cate->id}}">{{$cate->nombre}}</option>
                    @endforeach
                </select>

                @error('categoria')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                        <strong class="font-bold">Error</strong>
                        <span class="block">{{$message}} </span>
                    </div>
                @enderror
            </div>



            <div class="mb-5">
                <label for="experiencia" class="block text-gray-700 text-sm mb-2">Experiencia:</label>
                <select name="experiencia" id="experiencia" class="block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100 w-full">
                    <option disabled selected >-Selecciona-</option>
                    @foreach ($Experiencias as $exp)
                        <option {{ $vacante->experiencia_id == $exp->id ? 'selected' : '' }}  value="{{$exp->id}}">{{$exp->nombre}}</option>
                    @endforeach
                </select>


                @error('experiencia')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                        <strong class="font-bold">Error</strong>
                        <span class="block">{{$message}} </span>
                    </div>
                @enderror
            </div>



            <div class="mb-5">
                <label for="ubicacion" class="block text-gray-700 text-sm mb-2">Ubicacion:</label>
                <select name="ubicacion" id="ubicacion" class="block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100 w-full">
                    <option disabled selected >-Selecciona-</option>
                    @foreach ($ubicacion as $u)
                        <option {{ $vacante->ubicacion_id == $u->id ? 'selected' : '' }} value="{{$u->id}}">{{$u->nombre}}</option>
                    @endforeach
                    </select>


                    @error('ubicacion')
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                            <strong class="font-bold">Error</strong>
                            <span class="block">{{$message}} </span>
                        </div>
                    @enderror
            </div>




            <div class="mb-5">
                <label for="salario" class="block text-gray-700 text-sm mb-2">Salario:</label>
                <select name="salario" id="salario" class="block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100 w-full">
                    <option disabled selected >-Selecciona-</option>
                    @foreach ($salarios as $s)
                        <option {{ $vacante->salario_id == $s->id ? 'selected' : '' }} value="{{$s->id}}">{{$s->nombre}}</option>
                    @endforeach
                </select>


            </div>


            {{-- !Aqui se colocara el editor de medium --}}
            <div class="mb-5">
                <label for="description" class="block text-gray-700 text-sm mb-2">Descripcion del puesto:</label>
                <div class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700"> </div>
                <input type="hidden" name="description" id="description" value="{{$vacante->descripcion}}">

                @error('description')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                        <strong class="font-bold">Error</strong>
                        <span class="block">{{$message}} </span>
                    </div>
                @enderror
            </div>



            {{-- !Aqui se colocara dropzone --}}
            <div class="mb-5">
                <label for="imagen" class="block text-gray-700 text-sm mb-2">Imagen vacante:</label>
                <div class="dropzone rounded bg-gray-100" id="dropzoneDev"> </div>

                <input type="hidden" name="imagen" id="imagen" value="{{$vacante->imagen}}">
                <p id="error"></p>

                @error('imagen')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                        <strong class="font-bold">Error</strong>
                        <span class="block">{{$message}} </span>
                    </div>
                @enderror
            </div>



            <div class="mb-5">
                <label for="habilidad" class="block text-gray-700 text-sm mb-5">Habilidades y conocimientos
                    <span class="text-xs">(Elige al menos 3)</span>

                </label>
                @php
                    $skills = ['HTML5', 'CSS3', 'CSSGrid', 'Flexbox', 'JavaScript', 'jQuery', 'Node', 'Angular', 'VueJS', 'ReactJS', 'React Hooks', 'Redux', 'Apollo', 'GraphQL', 'TypeScript', 'PHP', 'Laravel', 'Symfony', 'Python', 'Django', 'ORM', 'Sequelize', 'Mongoose', 'SQL', 'MVC', 'SASS', 'WordPress', 'Express', 'Deno', 'React Native', 'Flutter', 'MobX', 'C#', 'Ruby on Rails']
                @endphp
                <lista-skills :skills="{{json_encode($skills)}}" :oldskills="{{ json_encode($vacante->habilidad)}}"></lista-skills>

                @error('habilidad')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error</strong>
                    <span class="block">{{$message}} </span>
                </div>
                @enderror

            </div>


            <button type="submit" class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 p-3 focus:outline focus:shadow-outline uppercase font-bold ">
                Publicar vacante
            </button>

        </div>
    </form>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/js/medium-editor.min.js"></script>
    <script>
        Dropzone.autoDiscover = false; // para que no lo busque automaticamente y no nos de error
            document.addEventListener('DOMContentLoaded', () => {
                    //? Medium editor
                    const editor = new MediumEditor('.editable',{
                        toolbar:{
                            buttons:['bold','italic', 'underline', 'quote', 'anchor','justifyLeft','justifyCenter','justifyRight','justifyFull','orderedList','unorderedList','h2','h3'],
                            static:true,
                            sticky:true
                        },
                        placeholder:{
                            text:'Informacion de la vacante'
                        }
                    });

                    // Para pasar el contenido al input para guardarlo en la base de datos
                    editor.subscribe('editableInput', function(eventObj, editable){
                        const contenido = editor.getContent();
                        document.querySelector('#description').value = contenido
                    })

                    //llenar el editor con el dato del input hiiden
                    editor.setContent(document.querySelector('#description').value);
                    // ! Dropzone
                    const dropzoneDev = new Dropzone('#dropzoneDev',{
                        url:"/vacantes/imagen",
                        dictDefaultMessage:'Sube aqui tu archivo',
                        acceptedFiles:".png, .jpg,.jpeg, . gif, .bmp",
                        addRemoveLinks:true,
                        dictRemoveFile:'Borrar',
                        maxFiles:1,//para indicar cuanto archivos maximos aceptara
                        headers:{
                            'X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content //token para que no haya error
                        },
                        init:function(){
                            if(document.querySelector('#imagen').value.trim()){
                                let imagenPublicada = { };
                                imagenPublicada.size = 1234;
                                imagenPublicada.name = document.querySelector('#imagen').value
                                imagenPublicada.nombreServidor =  document.querySelector('#imagen').value

                                this.options.addedfile.call(this, imagenPublicada)
                                this.options.thumbnail.call(this, imagenPublicada, `/storage/vacantes/${ imagenPublicada.name } `)

                                imagenPublicada.previewElement.classList.add('dz-sucess')
                                imagenPublicada.previewElement.classList.add('dz-complete')
                            }

                        },

                        success:function( file, response ) {
                            document.querySelector('#error').textContent = ''
                            // Colocar la respuesta del servidor en el input hidden
                            document.querySelector('#imagen').value = response.correcto

                            //Añadir al objeto de archivo el nombre del servidor
                            file.nombreServidor = response.correcto;
                        },
                        // error: function (file, response) {
                        //     document.querySelector('#error').textContent = 'Formato no valido'
                        // },
                        maxfilesexceeded: function(file){//TODO: se activara cuando pasemos el limite de archivos permitidos
                            if(this.files[1] != null){
                                this.removeFile(this.files[0])//Eliminar archivo anterior
                                this.addFile(file)//agregar ael nuevo archivo
                            }
                        },

                        removedfile: function(file, response ){

                            file.previewElement.parentNode.removeChild(file.previewElement) /* !El previewElement esta en el file es donde se muestra la imagen en el dom */

                            params = {
                                imagen: file.nombreServidor
                            }

                            axios.post('/vacantes/borrarimagen',params )
                                    .then(response => console.log(response))
                        }
                    })

            });

    </script>
@endsection

