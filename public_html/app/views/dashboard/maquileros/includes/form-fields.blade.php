
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="form-group">
        <div class="col-md-4" >
            <label for="">Nombre
                {{($errors->first("nombre")) ? $errors->first("nombre")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Nombre']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">Persona Contacto
                {{($errors->first("persona_contacto")) ? $errors->first("persona_contacto")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('persona_contacto', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Persona de Contacto']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">RFC
                {{($errors->first("rfc")) ? $errors->first("rfc")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('rfc', null, ['class' => 'form-control', 'placeholder' => 'Ingresar RFC']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">Calle
                {{($errors->first("calle")) ? $errors->first("calle")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('calle', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Calle']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">Número Interior
                {{($errors->first("numinterior")) ? $errors->first("numinterior")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('numinterior', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Número Interior']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">Número Exterior
                {{($errors->first("numexterior")) ? $errors->first("numexterior")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('numexterior', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Número Exterior']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">Colonia
                {{($errors->first("colonia")) ? $errors->first("colonia")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('colonia', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Colonia']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">C.P.
                {{($errors->first("cp")) ? $errors->first("cp")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('cp', null, ['class' => 'form-control', 'placeholder' => 'Ingresar  C.P.']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">Municipio
                {{($errors->first("municipio")) ? $errors->first("municipio")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('municipio', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Municipio']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">Pais
                {{($errors->first("pais")) ? $errors->first("pais")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('pais', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Pais']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">E-mail
                {{($errors->first("email")) ? $errors->first("email")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingresar E-mail']) }}
        </div>
    </div>

     <div class="col-md-4" >
        <div class="form-group">
            <label for="">Especialidad
                {{($errors->first("especialidad")) ? $errors->first("especialidad")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('especialidad', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Especialidad']) }}
        </div>
    </div>

     <div class="col-md-4" >
        <div class="form-group">
            <label for="">Información Adicional
                {{($errors->first("infoadicional")) ? $errors->first("infoadicional")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('infoadicional', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Información Adicional']) }}
        </div>
    </div>

    <div class="col-md-4" >
        <div class="form-group">
            <label for="">Teléfono (10 dígitos)
                {{($errors->first("telefono")) ? $errors->first("telefono")." <span class='symbol required'></span>": ''}}
            </label>
            {{ Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingresar Teléfono']) }}
        </div>
    </div>
