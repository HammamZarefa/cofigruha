{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('id', 'Id:') !!}
			{!! Form::text('id') !!}
		</li>
		<li>
			{!! Form::label('socio', 'Socio:') !!}
			{!! Form::text('socio') !!}
		</li>
		<li>
			{!! Form::label('cif', 'Cif:') !!}
			{!! Form::text('cif') !!}
		</li>
		<li>
			{!! Form::label('nombre', 'Nombre:') !!}
			{!! Form::text('nombre') !!}
		</li>
		<li>
			{!! Form::label('razon_social', 'Razon_social:') !!}
			{!! Form::text('razon_social') !!}
		</li>
		<li>
			{!! Form::label('province', 'Province:') !!}
			{!! Form::text('province') !!}
		</li>
		<li>
			{!! Form::label('ciudad', 'Ciudad:') !!}
			{!! Form::text('ciudad') !!}
		</li>
		<li>
			{!! Form::label('direccion', 'Direccion:') !!}
			{!! Form::text('direccion') !!}
		</li>
		<li>
			{!! Form::label('codigo_postal', 'Codigo_postal:') !!}
			{!! Form::text('codigo_postal') !!}
		</li>
		<li>
			{!! Form::label('logo', 'Logo:') !!}
			{!! Form::text('logo') !!}
		</li>
		<li>
			{!! Form::label('web', 'Web:') !!}
			{!! Form::text('web') !!}
		</li>
		<li>
			{!! Form::label('mail', 'Mail:') !!}
			{!! Form::text('mail') !!}
		</li>
		<li>
			{!! Form::label('doc_medios_pdf', 'Doc_medios_pdf:') !!}
			{!! Form::text('doc_medios_pdf') !!}
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
			{!! Form::label('certificado', 'Certificado:') !!}
			{!! Form::text('certificado') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}