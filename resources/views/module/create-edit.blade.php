@extends('layouts.app')
@section('title', isset($module) ?  'Editar Módulo '. $module->name : 'Crear Modulo' )
@section('parent-page','Módulos')
@section('route-parent',route('modules.index') )


@section('content')
<div class="row">
	<div class="col-12">
		<div class="card p-30">
			<div class="row">
				<div class="card-title col-12 px-0">
					<h3>@if (isset($module)) {{  'Editar Módulo '. $module->name }} @else Crear Módulo @endif </h3>
				</div>
				<div class="card-body col-12">
					@if (session()->has('mensaje'))
						<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
							{{ session()->get('mensaje') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						</div>
					@endif
					<div class="form-validation">
						<form action="@if(isset($module)) {{ route('modules.update',$module->id) }} @else {{ route('modules.store') }} @endif" class="form-validator crud-futbol" method="POST">
							{{ csrf_field() }}
							@if (isset($module))
								<input type="hidden" name="key" value="{{ $module->id }}">
								<input type="hidden" name="_method" value="PUT">
							@endif
							<div class="row">
								<div class="col-lg-4 col-7">
									<div class="form-group {{ $errors->has('name') ? ' is-invalid' : '' }}">
										<label for="name">Nombre <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="name" value="@if(isset($module)){{ $module->name }} @else{{ old('name') }} @endif" autofocus="">
										@if ($errors->has('name'))
										    <span class="invalid-feedback animated fadeInDown">
										        <strong>{{ $errors->first('name') }}</strong>
										    </span>
										@endif
									</div>
								</div>

								<div class="col-lg-2 col-5">
									<div class="form-group {{ $errors->has('order') ? ' is-invalid' : '' }}">
										<label for="order">Orden <span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="order" name="order" value="@if(isset($module)){{ $module->order }} @else{{ old('order') }} @endif">
										@if ($errors->has('order'))
										    <span class="invalid-feedback animated fadeInDown">
										        <strong>{{ $errors->first('order') }}</strong>
										    </span>
										@endif
									</div>
								</div>
							</div>
						
					</div>
				</div>

				<div class="card-footer col-12">
					<div class="row">
						<button class="btn btn-primary btn-sm mx-1" type="submit"><i class="fa fa-save"></i> @if (isset($module)) Actualizar @else Guardar @endif</button>
						<button class="btn btn-warning btn-sm mx-1 save-close" type="submit"><i class="fa fa-save"></i> @if(isset($module)) Actualizar @else Guardar @endif y Cerrar </button>
						<input type="hidden" name="redirect" id="redirect" value="0">
						<a class="btn btn-secondary btn-sm mx-1" href="{{ route('modules.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection()