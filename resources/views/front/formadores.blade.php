

{!! Form::open(array('route' => 'formadores.store', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('id', 'Id:') !!}
			{!! Form::text('id') !!}
		</li>
		<li>
			{!! Form::label('codigo', 'Codigo:') !!}
			{!! Form::text('codigo') !!}
		</li>
		<li>
			{!! Form::label('entidad', 'Entidad:') !!}
			{!! Form::text('entidad') !!}
		</li>
		<li>
			{!! Form::label('apellidos', 'Apellidos:') !!}
			{!! Form::text('apellidos') !!}
		</li>
		<li>
			{!! Form::label('nombre', 'Nombre:') !!}
			{!! Form::text('nombre') !!}
		</li>
		<li>
			{!! Form::label('dni', 'Dni:') !!}
			{!! Form::text('dni') !!}
		</li>
		<li>
			{!! Form::label('dni_img', 'Dni_img:') !!}
			{!! Form::text('dni_img') !!}
		</li>
		<li>
			{!! Form::label('operador_pdf', 'Operador_pdf:') !!}
			{!! Form::text('operador_pdf') !!}
		</li>
		<li>
			{!! Form::label('cert_empresa_pdf', 'Cert_empresa_pdf:') !!}
			{!! Form::text('cert_empresa_pdf') !!}
		</li>
		<li>
			{!! Form::label('vida_laboral_pdf', 'Vida_laboral_pdf:') !!}
			{!! Form::text('vida_laboral_pdf') !!}
		</li>
		<li>
			{!! Form::label('prl_pdf', 'Prl_pdf:') !!}
			{!! Form::text('prl_pdf') !!}
		</li>
		<li>
			{!! Form::label('pemp_pdf', 'Pemp_pdf:') !!}
			{!! Form::text('pemp_pdf') !!}
		</li>
		<li>
			{!! Form::label('cap_pdf', 'Cap_pdf:') !!}
			{!! Form::text('cap_pdf') !!}
		</li>
		<li>
			{!! Form::label('fecha', 'Fecha:') !!}
			{!! Form::text('fecha') !!}
		</li>
		<li>
			{!! Form::label('estado', 'Estado:') !!}
			{!! Form::text('estado') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
