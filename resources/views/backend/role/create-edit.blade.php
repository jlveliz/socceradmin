@extends('layouts.backend')

@section('title', isset($role) ?  'Editar Rol '. $role->name : 'Crear Rol' )
@section('parent-page','Roles')
@section('route-parent',route('roles.index') )
@section('current-page', isset($role) ?  'Editar Rol '. $role->name : 'Crear Rol' )

@section('content')

<!-- Start Page Content -->
<div class="row">
    <div class="col-12 ">
        <div class="card p-30">
    		<div class="card-body">
    			@if (session()->has('type') && session()->has('content'))
    				<div class="alert alert-{{ session()->get('type') }}  sufee-alert alert with-close alert-dismissible fade show">
    					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    					{{ session()->get('content') }}
    				</div>
    			@endif
            	<form action="@if(isset($role)) {{ route('roles.update',['id'=>$role->id]) }} @else {{ route('roles.store') }} @endif" method="POST" class="crud-futbol">
            		{{ csrf_field() }}
            		@if (isset($role))
            			<input type="hidden" name="_method" value="PUT">
            			<input type="hidden" name="key" value="{{ $role->id }}">
            		@endif
                	<div class="row">
                		<div class="col-lg-3 col-6">
	                		<div class="form-group">
	                			<label for="name">Nombre <span class="text-danger">*</span></label>
	                			<input type="text" name="name" id="name" class="form-control @if ($errors->has('name')) is-invalid @endif"  autofocus="" value="@if(isset($role)){{ $role->name }}@else{{ old('name') }}@endif">
	                			@if ($errors->has('name'))
	                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
	                			@endif
	                		</div>
                		</div>
                		<div class="col-lg-3 col-6">
	                		<div class="form-group">
	                			<label for="is_default">Predeterminado <span class="text-danger">*</span></label>
	                			<select name="is_default" id="is_default" class="form-control custom-select @if ($errors->has('is_default')) is-invalid @endif">
	                				<option value="1" @if( (isset($role) && $role->is_default == '1') || ( old('is_default') == '1' ) ) selected @endif>Si</option>
	                				<option value="0" @if( (isset($role) && $role->is_default == '0') || ( old('is_default') == '0' ) ) selected @endif>No</option>
	                			</select>
	                			@if ($errors->has('is_default'))
	                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('is_default') }}</div>
	                			@endif
	                		</div>
                		</div>
                		<div class="col-lg-6 col-12">
	                		<div class="form-group @if ($errors->has('description')) is-invalid @endif">
	                			<label for="description">Descripción</label>
	                			<input type="text" name="description" id="description" class="form-control"  autofocus="" value="@if(isset($role)){{ $role->description }}@else{{ old('description') }}@endif" >
	                			@if ($errors->has('description'))
	                				<div id="val-order-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('description') }}</div>
	                			@endif
	                		</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-12">
                			<h4>Permisos  </h4>
                			<hr>
							{{-- permission types --}}
							<ul class="nav nav-tabs" id="tabPermissions" role="tablist">
								@foreach ($permissionTypes as $keyPtype =>  $pType)
									<li class="nav-item">
										<a class="nav-link @if($keyPtype == 0) active @endif" id="{{$pType->code}}-tab" data-toggle="tab" href="#{{$pType->code}}-content" role="tab" aria-controls="{{$pType->code}}" aria-selected="@if($keyPtype == 0) true @else false @endif">{{$pType->name}}</a>
									</li>
								@endforeach
							</ul>

							<div class="tab-content" id="myTabContent">
								@foreach ($permissionTypes as $keyPtype =>  $pType)
									<div class="tab-pane fade  @if($keyPtype == 0) show active @endif" id="{{$pType->code}}-content" role="tabpanel" aria-labelledby="{{$pType->code}}-tab">
										

										{{-- content permissions --}}

			                			<div class="accordion" id="accordionpermissions">
			                				<div class="row">
				                				@foreach ($modules as $index => $module)
				                					<div class="card col-lg-6 col-12 p-0">
				                						{{-- {{dd($pType->code.'_'.($index+1))}} --}}
				                						<div class="card-header px-2" id="heading_{{$pType->code.'_'.($index+1)}}">
				                							<a href="#" data-toggle="collapse" data-target="#{{$pType->code.'_'.str_slug($module->name).'_'.$module->id}}" aria-expanded="true" aria-controls="collapse{{($index+1)}}">{{$module->name}} </a>
				                						</div>
				                						<div id="{{$pType->code.'_'.str_slug($module->name).'_'.$module->id}}" class="collapse show" aria-labelledby="heading_{{$pType->code.'_'.($index+1)}}" data-parent="#accordionpermissions">
					                						<div class="card-body">
					                							<table class="table">
					                								@foreach ($module->getPermissionsType($pType->id) as $permission)
						                								<tr>
						                									<td>
						                										<div class="input-group">
						                											<div class="input-group-prepend col-12 px-0">
						                												<div class="input-group-text">
						                													<input type="checkbox" aria-label="Checkbox for following text input" name="permissions[]" value="{{$permission->id}}" id="permission_{{$permission->id}}" @if(isset($role) && $role->hasPermission($permission->id)) checked @endif @if(count($permission->children) > 0) class="input-menu-has-children" for="childs-opt-menu-table_{{$permission->id}}" @endif>
						                												</div>
						                												<label for="permission_{{$permission->id}}" class="col-form-label ml-2">{{$permission->name}}</label>
						                											</div>
						                										</div>
						                										{{-- have childs --}}
					                									@if (count($permission->children) > 0)
					                										<table class="table ml-3" id="childs-opt-menu-table_{{$permission->id}}">
						                										@foreach ($permission->children as $children)
					                												<tr>
					                													<td>
					                														<div class="form-check"><input type="checkbox" id="children_{{$children->id}}" class="form-check-input" parent="{{$children->parent->id}}"@if(isset($role) && $role->hasPermission($children->id)) checked 
					                														@endif>
					                														<label for="children_{{$children->id}}" class="form-check-label">{{$children->name}}</label>
					                														</div>
					                													</td>
					                												</tr>
						                											
						                										@endforeach
					                										</table>
					                									@endif
						                									</td>
						                								</tr>

					                								@endforeach
					                							</table>
					                						</div>
				                						</div>
				                					</div>
				                				@endforeach
			                				</div>
			                			</div>

									</div>
								@endforeach
							</div>

                		</div>
                	</div>
    		</div>
            <div class="card-footer">
            	<div class="form-actions">
            		<input type="hidden" value="0" name="redirect-index" id="redirect-index">
            		<button class="btn btn-primary btn-sm" type="submit"><i class="i-Data-Save"></i> Guardar</button>
            		<button class="btn btn-secondary btn-sm save-close" type="submit"><i class="i-Data-Save"></i> Guardar y Cerrar</button>
            		<a class="btn btn-inverse btn-sm" href="{{ route('roles.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
            	</div>
            </div>
    			</form>
        </div>
    </div>
</div>
<!-- End PAge Content -->
@endsection