@extends('panel.layout')

@section('title', 'Matrícula ' . $matricula->codigo)

@section('content')
@php
    $badges = ['pendiente' => 'pm-badge-amber', 'pagada' => 'pm-badge-green', 'cancelada' => 'pm-badge-gray', 'vencida' => 'pm-badge-red'];
    $alumno = $matricula->alumno;
    $apoderado = $alumno?->apoderado;
@endphp

<a href="{{ route('panel.index') }}" class="pm-back"><i class="bi bi-arrow-left"></i> Volver al listado</a>

<div class="pm-head">
    <div>
        <h1>Matrícula <code>{{ $matricula->codigo }}</code></h1>
        <p class="pm-muted mb-0">
            Registrada el {{ $matricula->fecha_registro?->format('d/m/Y H:i') }}
            @if($matricula->conversacion) · <i class="bi bi-robot"></i> por el chatbot @endif
        </p>
    </div>
    <span class="pm-badge pm-badge-lg {{ $badges[$matricula->estado_visible] ?? 'pm-badge-gray' }}">{{ ucfirst($matricula->estado_visible) }}</span>
</div>

<div class="pm-grid">
    <div class="pm-col">
        @if($matricula->estado !== 'pagada' && $matricula->estado !== 'cancelada')
            <section class="pm-card pm-verify" id="verificar">
                <h2><i class="bi bi-cash-coin"></i> Verificar pago</h2>
                <p class="pm-muted">Confirma que el depósito de <strong>S/ {{ number_format($matricula->monto_total, 2) }}</strong> llegó a la cuenta. Al verificarlo se activa la cuenta del alumno y se envía el correo de bienvenida con sus credenciales.</p>
                <form action="{{ route('panel.estado', $matricula->id_matricula) }}" method="POST"
                      data-confirmar="¿Confirmas que el pago de {{ $matricula->codigo }} llegó? Se enviará el correo de bienvenida.">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="estado" value="pagada">
                    <label class="form-label" for="comprobante">N° de operación o comprobante (opcional)</label>
                    <div class="pm-inline-form">
                        <input id="comprobante" type="text" name="comprobante" class="form-control" maxlength="255" placeholder="Ej.: 0012345">
                        <button class="pm-btn pm-btn-green text-nowrap"><i class="bi bi-check2-circle"></i> Verificar y enviar bienvenida</button>
                    </div>
                </form>
            </section>
        @endif

        <section class="pm-card">
            <h2><i class="bi bi-person"></i> Alumno</h2>
            @if($alumno)
                <dl class="pm-dl">
                    <dt>Nombre</dt><dd>{{ $alumno->nombre_completo }}</dd>
                    <dt>DNI</dt><dd>{{ $alumno->dni }}</dd>
                    <dt>Nacimiento</dt><dd>{{ $alumno->fecha_nacimiento?->format('d/m/Y') ?? '—' }}</dd>
                    <dt>Correo</dt><dd>{{ $alumno->email ?? '—' }}</dd>
                    <dt>Celular</dt><dd>{{ $alumno->telefono ?? '—' }}</dd>
                </dl>

                @if($credenciales)
                    <div class="pm-cred {{ $matricula->estado === 'pagada' ? 'is-active' : '' }}">
                        <div class="pm-cred-title">
                            <i class="bi bi-key"></i>
                            {{ $matricula->estado === 'pagada' ? 'Credenciales de la intranet' : 'Credenciales que tendrá al verificar el pago' }}
                        </div>
                        <div class="pm-cred-row"><span>Usuario</span><code>{{ $credenciales['usuario'] }}</code></div>
                        <div class="pm-cred-row"><span>Contraseña</span><code>{{ $credenciales['password'] }}</code></div>
                        @unless($correo['activo'])
                            <small class="d-block mt-2">El correo no está configurado: entrégaselas al alumno personalmente.</small>
                        @endunless
                    </div>
                @endif
            @else
                <p class="pm-muted mb-0">No se encontró el alumno de esta matrícula.</p>
            @endif

            @if($apoderado)
                <h3 class="pm-subtitle"><i class="bi bi-person-badge"></i> Apoderado</h3>
                <dl class="pm-dl">
                    <dt>Nombre</dt><dd>{{ $apoderado->nombre }} {{ $apoderado->apellido }}</dd>
                    <dt>DNI</dt><dd>{{ $apoderado->dni }}</dd>
                    <dt>Celular</dt><dd>{{ $apoderado->telefono ?? '—' }}</dd>
                    <dt>Correo</dt><dd>{{ $apoderado->correo ?? '—' }}</dd>
                </dl>
            @endif
        </section>
    </div>

    <div class="pm-col">
        <section class="pm-card">
            <h2><i class="bi bi-mortarboard"></i> Programa</h2>
            <dl class="pm-dl">
                <dt>Modalidad</dt><dd>{{ ucfirst($matricula->modalidad) }}</dd>
                <dt>Elección</dt><dd>{{ $matricula->eleccion }}</dd>
                <dt>Ciclo / grado</dt><dd>{{ $matricula->ciclo_grado }}</dd>
                <dt>Ciclo</dt><dd>{{ $matricula->ciclo?->nombre ?? '—' }}</dd>
                @if($matricula->ciclo)
                    <dt>Fechas</dt><dd>{{ $matricula->ciclo->fecha_inicio->format('d/m/Y') }} – {{ $matricula->ciclo->fecha_fin->format('d/m/Y') }}</dd>
                @endif
                <dt>Sede</dt><dd>{{ $matricula->sede }}</dd>
                <dt>Entorno</dt><dd>{{ $matricula->entorno }}</dd>
                <dt>Turno</dt><dd>{{ $matricula->turno }}</dd>
            </dl>
        </section>

        <section class="pm-card">
            <h2><i class="bi bi-wallet2"></i> Pago</h2>
            <dl class="pm-dl">
                @if($detallePago)
                    <dt>Concepto</dt><dd>{{ $detallePago['concepto'] }}</dd>
                    <dt>Importe</dt><dd>S/ {{ number_format($detallePago['importe'], 2) }}</dd>
                    <dt>Descuento</dt><dd>− S/ {{ number_format($detallePago['descuento'], 2) }}</dd>
                @endif
                <dt>Total</dt><dd class="pm-total">S/ {{ number_format($matricula->monto_total, 2) }}</dd>
                <dt>Plazo de pago</dt><dd>{{ $matricula->fecha_expiracion?->format('d/m/Y H:i') ?? '—' }}</dd>
                <dt>Estado del pago</dt>
                <dd>
                    <span class="pm-badge {{ ['pagado' => 'pm-badge-green', 'fallido' => 'pm-badge-red'][$matricula->estado_pago] ?? 'pm-badge-amber' }}">{{ ucfirst($matricula->estado_pago ?? 'pendiente') }}</span>
                    @if($matricula->estado_pago === 'fallido' && $matricula->ultimo_error_pago)
                        <small class="d-block pm-muted">Motivo: {{ $matricula->ultimo_error_pago }}</small>
                    @endif
                </dd>
                @if($matricula->id_transaccion)
                    <dt>N° de transacción</dt><dd><code>{{ $matricula->id_transaccion }}</code></dd>
                @endif
                @if($matricula->fecha_pago)
                    <dt>Fecha de pago</dt><dd>{{ $matricula->fecha_pago->format('d/m/Y H:i') }}</dd>
                @endif
                <dt>Constancia</dt><dd>{{ $matricula->correo_enviado_at ? 'Enviada el ' . $matricula->correo_enviado_at->format('d/m/Y H:i') : 'No enviada' }}</dd>
            </dl>

            @forelse($matricula->pagos as $pago)
                <div class="pm-pago">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>
                        <strong>S/ {{ number_format($pago->monto, 2) }}</strong> · {{ ucfirst($pago->estado) }} el {{ $pago->fecha_pago?->format('d/m/Y') }}
                        @if($pago->comprobante)<small class="d-block">Operación: {{ $pago->comprobante }}</small>@endif
                        @if($pago->verificado_por)<small class="d-block">Verificó: {{ $pago->verificado_por }}</small>@endif
                    </div>
                </div>
            @empty
                <p class="pm-muted mb-0">Aún no hay pagos registrados.</p>
            @endforelse
        </section>

        <section class="pm-card">
            <h2><i class="bi bi-gear"></i> Otras acciones</h2>
            <div class="d-flex flex-wrap gap-2">
                @if($matricula->estado === 'pagada')
                    <form action="{{ route('panel.notificaciones', $matricula->id_matricula) }}" method="POST"
                          data-confirmar="Se reenviará el correo de bienvenida con las credenciales. ¿Continuar?">
                        @csrf
                        <button class="pm-btn pm-btn-light"><i class="bi bi-envelope"></i> Reenviar bienvenida</button>
                    </form>
                @endif

                @if($matricula->estado === 'cancelada')
                    <form action="{{ route('panel.estado', $matricula->id_matricula) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="estado" value="pendiente">
                        <button class="pm-btn pm-btn-light"><i class="bi bi-arrow-counterclockwise"></i> Reactivar con nuevo plazo</button>
                    </form>
                @elseif($matricula->estado !== 'pagada')
                    <form action="{{ route('panel.estado', $matricula->id_matricula) }}" method="POST" data-confirmar="¿Cancelar esta matrícula?" data-confirmar-tipo="peligro">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="estado" value="cancelada">
                        <button class="pm-btn pm-btn-danger-light"><i class="bi bi-x-circle"></i> Cancelar matrícula</button>
                    </form>
                @else
                    <p class="pm-muted mb-0 small">Esta matrícula ya está pagada; para anularla comunícate con la dirección.</p>
                @endif
            </div>
        </section>
    </div>
</div>
@endsection
