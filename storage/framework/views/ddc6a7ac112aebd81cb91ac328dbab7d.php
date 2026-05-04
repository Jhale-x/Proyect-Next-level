<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/Mensajes.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Mensajes - Next Level'); ?>

<?php $__env->startSection('content'); ?>
<div class="messages-container">
    
    <div class="messages-header">
        <h4>Mensajes</h4>
        <p>Conversaciones activas con tus profesores y compañeros</p>
    </div>

    <div class="conversations-grid">
        
        <!-- Conversación 1 -->
        <div class="conversation-card" onclick="openChat(1, 'BASIC 4', 'Prof. Rodríguez')">
            <div class="conversation-header">
                <div class="conversation-title">
                    <h6>BASIC 4</h6>
                    <span class="course-code">202602-INGL-155-TEC-NRC_76</span>
                </div>
                <div class="conversation-badge badge-blue">
                    <i class="bi bi-chat-dots"></i>
                </div>
            </div>
            <div class="conversation-body">
                <div class="last-message">
                    <div class="message-avatar">
                        <span>PR</span>
                    </div>
                    <div class="message-preview">
                        <span class="sender">Prof. Rodríguez</span>
                        <p class="message-text">Recuerden entregar la tarea para el viernes...</p>
                        <span class="message-time">Hace 2 horas</span>
                    </div>
                </div>
                <div class="unread-indicator"></div>
            </div>
            <div class="conversation-footer">
                <button class="btn-send-message" onclick="event.stopPropagation(); openChat(1, 'BASIC 4', 'Prof. Rodríguez')">
                    <i class="bi bi-send"></i> Responder
                </button>
            </div>
        </div>

        <!-- Conversación 2 -->
        <div class="conversation-card" onclick="openChat(2, 'Inducción a la Seguridad', 'Sistema')">
            <div class="conversation-header">
                <div class="conversation-title">
                    <h6>Inducción a la Seguridad</h6>
                    <span class="course-code">PREVENCION-202510-38</span>
                </div>
                <div class="conversation-badge badge-green">
                    <i class="bi bi-shield-check"></i>
                </div>
            </div>
            <div class="conversation-body">
                <div class="last-message">
                    <div class="message-avatar">
                        <span>SI</span>
                    </div>
                    <div class="message-preview">
                        <span class="sender">Sistema</span>
                        <p class="message-text">Bienvenidos al curso. Revisen el material de bienvenida...</p>
                        <span class="message-time">Ayer</span>
                    </div>
                </div>
            </div>
            <div class="conversation-footer">
                <button class="btn-send-message" onclick="event.stopPropagation(); openChat(2, 'Inducción a la Seguridad', 'Sistema')">
                    <i class="bi bi-send"></i> Responder
                </button>
            </div>
        </div>

        <!-- Conversación 3 -->
        <div class="conversation-card" onclick="openChat(3, 'Inducción para estudiantes', 'Coordinación')">
            <div class="conversation-header">
                <div class="conversation-title">
                    <h6>Inducción para estudiantes</h6>
                    <span class="course-code">IND_ALUMNOS-202520-38</span>
                </div>
                <div class="conversation-badge badge-orange">
                    <i class="bi bi-megaphone"></i>
                </div>
            </div>
            <div class="conversation-body">
                <div class="last-message">
                    <div class="message-avatar">
                        <span>CO</span>
                    </div>
                    <div class="message-preview">
                        <span class="sender">Coordinación</span>
                        <p class="message-text">Horarios publicados para el siguiente módulo...</p>
                        <span class="message-time">Hace 3 días</span>
                    </div>
                </div>
            </div>
            <div class="conversation-footer">
                <button class="btn-send-message" onclick="event.stopPropagation(); openChat(3, 'Inducción para estudiantes', 'Coordinación')">
                    <i class="bi bi-send"></i> Responder
                </button>
            </div>
        </div>

        <!-- Conversación 4 -->
        <div class="conversation-card" onclick="openChat(4, 'Matemática Aplicada', 'Prof. García')">
            <div class="conversation-header">
                <div class="conversation-title">
                    <h6>Matemática Aplicada</h6>
                    <span class="course-code">202602-MATE-210-TEC</span>
                </div>
                <div class="conversation-badge badge-purple">
                    <i class="bi bi-calculator"></i>
                </div>
            </div>
            <div class="conversation-body">
                <div class="last-message">
                    <div class="message-avatar">
                        <span>PG</span>
                    </div>
                    <div class="message-preview">
                        <span class="sender">Prof. García</span>
                        <p class="message-text">Práctica calificada reprogramada para el lunes...</p>
                        <span class="message-time">Hace 5 días</span>
                    </div>
                </div>
                <div class="unread-indicator"></div>
            </div>
            <div class="conversation-footer">
                <button class="btn-send-message" onclick="event.stopPropagation(); openChat(4, 'Matemática Aplicada', 'Prof. García')">
                    <i class="bi bi-send"></i> Responder
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Modal de Chat -->
<div id="chatModal" class="chat-modal">
    <div class="chat-modal-header">
        <h6 id="chatTitle">Chat</h6>
        <button class="chat-modal-close" onclick="closeChat()">✕</button>
    </div>
    <div class="chat-modal-body" id="chatMessages">
        <!-- Mensajes aparecerán aquí -->
    </div>
    <div class="chat-modal-footer">
        <input type="text" id="chatInput" placeholder="Escribe tu mensaje...">
        <button onclick="sendMessage()">
            <i class="bi bi-send"></i>
        </button>
    </div>
</div>

<script>
let currentChatId = null;

function openChat(id, curso, profesor) {
    currentChatId = id;
    document.getElementById('chatTitle').innerHTML = `${curso} - ${profesor}`;
    document.getElementById('chatModal').classList.add('active');
    
    // Cargar mensajes de ejemplo
    const messagesDiv = document.getElementById('chatMessages');
    messagesDiv.innerHTML = `
        <div class="message-bubble incoming">
            <div class="bubble">Hola, bienvenido al curso de ${curso}</div>
        </div>
        <div class="message-bubble outgoing">
            <div class="bubble">Gracias, profesor. ¿Cuándo es la próxima evaluación?</div>
        </div>
        <div class="message-bubble incoming">
            <div class="bubble">La próxima evaluación será el viernes de la próxima semana</div>
        </div>
    `;
}

function closeChat() {
    document.getElementById('chatModal').classList.remove('active');
    currentChatId = null;
}

function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    if (!message) return;
    
    const messagesDiv = document.getElementById('chatMessages');
    messagesDiv.innerHTML += `
        <div class="message-bubble outgoing">
            <div class="bubble">${message}</div>
        </div>
    `;
    input.value = '';
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

// Cerrar modal al hacer clic fuera
document.addEventListener('click', function(event) {
    const modal = document.getElementById('chatModal');
    if (modal.classList.contains('active')) {
        if (!modal.contains(event.target) && !event.target.classList.contains('conversation-card') && !event.target.classList.contains('btn-send-message')) {
            closeChat();
        }
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Alumnoslanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/Alumno/messages.blade.php ENDPATH**/ ?>