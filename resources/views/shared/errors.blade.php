@if (!$errors->isEmpty())

@php
	$mensagem = '';
	foreach ($errors->all() as $error) {
		$mensagem .= $error . '<br>';
	}
@endphp
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Erro!', "{!! $mensagem !!}", 'error');
        })
    </script>
@endif