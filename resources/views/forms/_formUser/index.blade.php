
    @csrf


<div class="col-md-4">
    <div class="form-group">
        <label for="vc_nome">{{ __('Nome') }}</label>
        <input value="{{ isset($dados->name) ? $dados->name : '' }}" id="vc_nome"
            type="text" class="form-control @error('vc_nome') is-invalid @enderror" name="vc_nome"
            placeholder="Nome do utiizador" required autocomplete="vc_nome" >

    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="vc_genero">{{ __('Gênero') }}</label>
        <select class="form-control @error('vc_genero') is-invalid @enderror" name="vc_genero"
            required >

            <option value="M">Masculino</option>
            </option>
            <option value="F">Femenino</option>
            </option>

        </select>

        @error('vc_genero')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="vc_bi">{{ __('Nº BI') }}</label>
        <input value="{{ isset($dados->vc_bi) ? $dados->vc_bi : '' }}" id="vc_bi"
            type="text" class="form-control @error('vc_nome') is-invalid @enderror" name="vc_bi"
            placeholder="Número do Bilhete" required >

    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="email">{{ __('Email') }}</label>
        <input value="{{ isset($dados->email) ? $dados->email : '' }}" id="email"
            type="text" class="form-control @error('email') is-invalid @enderror" name="email"
            placeholder="Email do utiizador" required autocomplete="email" >

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
        <input value="" id="password"
            type="password" class="form-control @error('password') is-invalid @enderror" name="password"
            placeholder="Password do utiizador" value="" {{isset($dados) ? '' :'required'}} autocomplete="new-password" >

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="password_confirmation">{{ __('Confirme a Password') }}</label>
        <input value="" id="password_confirmation"
            type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
            placeholder="Confirma password do utiizador" value="" >

        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

 <div class="col-md-4">
    <div class="form-group">
        <label for="vc_perfil">{{ __('Perfil') }}</label>
        <select class="form-control @error('vc_perfil') is-invalid @enderror" name="vc_perfil"
            required autocomplete="vc_perfil" >

            <option {{ (isset($dados->vc_perfil) && ($dados->vc_perfil == "Administrador")) ? 'selected': '' }} value="Administrador">Administrador</option>
            </option>
            <option {{ (isset($dados->vc_perfil) && ($dados->vc_perfil == "Fiscal")) ? 'selected': '' }}  value="Fiscal">Fiscal</option>
            </option>
            <option {{ (isset($dados->vc_perfil) && ($dados->vc_perfil == "Publicitário")) ? 'selected': '' }}  value="Publicitário">Publicitário</option>
            <option  {{ (isset($dados->vc_perfil) && ($dados->vc_perfil == "Cliente")) ? 'selected': '' }} value="Cliente">Cliente</option>
            </option>
            <option {{ (isset($dados->vc_perfil) && ($dados->vc_perfil == "Master")) ? 'selected': '' }}  value="Master">Master</option>
            <option {{ (isset($dados->vc_perfil) && ($dados->vc_perfil == "Gráfica A")) ? 'selected': '' }}  value="Gráfica A">Gráfica A</option>
            <option {{ (isset($dados->vc_perfil) && ($dados->vc_perfil == "Gráfica B")) ? 'selected': '' }}  value="Gráfica B">Gráfica B</option>
        </option>
        </select>

        @error('vc_perfil')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
</div>
