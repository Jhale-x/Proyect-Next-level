@extends('layouts.Adminlanding')

@section('title', 'Matrícula ' . $matricula->codigo . ' | Next Level')

@section('content')
@php
    $badges = ['pendiente' => 'bg-warning text-dark', 'pagada' => 'bg-success', 'cancelada' => 'bg-secondary', 'vencida' => 'bg-danger'];
    $alumno = $matricula->alumno;
    $apoderado = $alumno?->apoderado;
@endphp
<div class="listado-container">

    <div class="listado-header">
        <h2><i class="bi bi-journal-check"></i> Matrícula <code>{{ $matricula->codigo }}</code></h2>
        <div class="header-stats d-flex gap-2 align-items-center">
            <span class="badge fs-6 {{ $badges[$matricula->estado_visible] ?? 'bg-light text-dark' }}">{{ ucfirst($matricula->estado_visible) }}</span>
            <a href="{{ route('admin.matriculas.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header fw-bold"><i class="bi bi-mortarboard"></i> Información académica</div>
                <div class="card-body">
                    <p class="mb-1"><strong>Modalidad:</strong> {{ ucfirst($matricula->modalidad) }}</p>
                    <p class="mb-1"><strong>Elección:</strong> {{ $matricula->eleccion }}</p>
                    <p class="mb-1"><strong>Ciclo / Grado:</strong> {{ $matricula->ciclo_grado }}</p>
                    <p class="mb-1"><strong>Ciclo:</strong> {{ $matricula->ciclo?->nombre ?? '—' }}</p>
                    @if($matricula->ciclo)
                        <p class="mb-1"><strong>Fechas:</strong> {{ $matricula->ciclo->fecha_inicio->format('d/m/Y') }} – {{ $matricula->ciclo->fecha_fin->format('d/m/Y') }}</p>
                    @endif
                    <p class="mb-1"><strong>Sede / Entorno / Turno:</strong> {{ $matricula->sede }} · {{ $matricula->entorno }} · {{ $matricula->turno }}</p>
                    <p class="mb-1"><strong>Registrada:</strong> {{ $matricula->fecha_registro?->format('d/m/Y H:i') }}</p>
                    <p class="mb-0"><strong>Plazo de pago:</strong> {{ $matricula->fecha_expiracion?->format('d/m/Y H:i') ?? '—' }}</p>
                    @if($matricula->conversacion)
                        <p class="mt-2 mb-0"><span class="badge bg-info text-dark"><i class="bi bi-robot"></i> Registrada por el chatbot</span></p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header fw-bold"><i class="bi bi-person"></i> Alumno</div>
                <div class="card-body">
                    @if($alumno)
                        <p class="mb-1"><strong>Nombre:</strong> {{ $alumno->nombre_completo }}</p>
                        <p class="mb-1"><strong>DNI:</strong> {{ $alumno->dni }}</p>
                        <p class="mb-1"><strong>Nacimiento:</strong> {{ $alumno->fecha_nacimiento?->format('d/m/Y') }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $alumno->email ?? '—' }}</p>
                        <p class="mb-1"><strong>Teléfono:</strong> {{ $alumno->telefono ?? '—' }}</p>
                        <p class="mb-0"><strong>Usuario intranet actual:</strong> <code>{{ $alumno->usuario }}</code></p>
                        @if($credenciales)
                            <div class="alert {{ $matricula->estado === 'pagada' ? 'alert-success' : 'alert-secondary' }} mt-3 mb-0 py-2">
                                <i class="bi bi-key"></i>
                                @if($matricula->estado === 'pagada')
                                    Credenciales: usuario <code>{{ $credenciales['usuario'] }}</code> · contraseña <code>{{ $credenciales['password'] }}</code>
                                @else
                                    Al verificar el pago tendrá: usuario <code>{{ $credenciales['usuario'] }}</code> · contraseña <code>{{ $credenciales['password'] }}</code>
                                @endif
                                @unless($correo['activo'])
                                    <small class="d-block">El correo no está configurado: entrégaselas al alumno.</small>
                                @endunless
                            </div>
                        @endif
                    @else
                        <p class="text-muted mb-0">Alumno no encontrado.</p>
                    @endif

                    @if($apoderado)
                        <hr>
                        <p class="fw-bold mb-1"><i class="bi bi-person-badge"></i> Apoderado</p>
                        <p class="mb-1">{{ $apoderado->nombre }} {{ $apoderado->apellido }} · DNI {{ $apoderado->dni }}</p>
                        <p class="mb-0">{{ $apoderado->telefono ?? '—' }} · {{ $apoderado->correo ?? '—' }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header fw-bold"><i class="bi bi-wallet2"></i> Pago</div>
                <div class="card-body">
                    @if($detallePago)
                        <p class="mb-1"><strong>Concepto:</strong> {{ $detallePago['concepto'] }}</p>
                        <p class="mb-1"><strong>Importe:</strong> S/ {{ number_format($detallePago['importe'], 2) }}</p>
                        <p class="mb-1"><strong>Descuento contado:</strong> S/ {{ number_format($detallePago['descuento'], 2) }}</p>
                    @endif
                    <p class="fs-5"><strong>Total:</strong> S/ {{ number_format($matricula->monto_total, 2) }}</p>

                    @forelse($matricula->pagos as $pago)
                        <p class="mb-1 text-success"><i class="bi bi-check-circle"></i> Pago {{ $pago->estado }} el {{ $pago->fecha_pago?->format('d/m/Y') }} — S/ {{ number_format($pago->monto, 2) }} {{ $pago->comprobante ? "· Op. {$pago->comprobante}" : '' }} {{ $pago->verificado_por ? "· Verificó: {$pago->verificado_por}" : '' }}</p>
                    @empty
                        <p class="text-muted">Sin pagos registrados.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header fw-bold"><i class="bi bi-gear"></i> Acciones</div>
                <div class="card-body">
                    @if($matricula->estado !== 'pagada')
                        <form action="{{ route('admin.matriculas.estado', $matricula->id_matricula) }}" method="POST" class="mb-3">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="estado" value="pagada">
                            <label class="form-label">N° de operación / comprobante (opcional)</label>
                            <div class="input-group">
                                <input type="text" name="comprobante" class="form-control" maxlength="255">
                                <button class="btn btn-success" onclick="return confirm('¿Verificaste el pago? Se enviará el correo de bienvenida con las credenciales.')"><i class="bi bi-cash-coin"></i> Verificar pago y enviar bienvenida</button>
                            </div>
                        </form>
                    @endif

                    <div class="d-flex flex-wrap gap-2">
                        @if($matricula->estado !== 'cancelada')
                            <form action="{{ route('admin.matriculas.estado', $matricula->id_matricula) }}" method="POST" onsubmit="return confirm('¿Cancelar esta matrícula?')">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="estado" value="cancelada">
                                <button class="btn btn-outline-danger"><i class="bi bi-x-circle"></i> Cancelar matrícula</button>
                            </form>
                        @else
                            <form action="{{ route('admin.matriculas.estado', $matricula->id_matricula) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="estado" value="pendiente">
                                <button class="btn btn-outline-secondary"><i class="bi bi-arrow-counterclockwise"></i> Reactivar</button>
                            </form>
                        @endif

                        @if($matricula->estado === 'pagada')
                            <form action="{{ route('admin.matriculas.notificaciones', $matricula->id_matricula) }}" method="POST" onsubmit="return confirm('Se reenviarán las credenciales (usuario: DNI, contraseña: fecha de nacimiento). ¿Continuar?')">
                                @csrf
                                <button class="btn btn-outline-primary"><i class="bi bi-envelope"></i> Reenviar bienvenida</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
