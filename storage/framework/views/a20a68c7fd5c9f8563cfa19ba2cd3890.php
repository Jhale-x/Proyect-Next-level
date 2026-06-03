<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/docente/messages.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Mensajes'); ?>

<?php $__env->startSection('content'); ?>

    <div class="messages-container">

        
        <div class="messages-header">
            <h4>Mensajes</h4>
            <p>Gestión de conversaciones del sistema</p>
        </div>

        
        <div class="conversations-grid">

            <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="conversation-card"
                    onclick="DocenteMessages.abrirCurso(<?php echo e($curso->id_curso); ?>, '<?php echo e($curso->materia); ?>')">

                    <div class="conversation-header">
                        <div>
                            <h6><?php echo e($curso->materia); ?></h6>
                            <span class="course-code">CURSO-<?php echo e($curso->id_curso); ?></span>
                        </div>

                        <div>📘</div>
                    </div>

                    <div class="conversation-body">
                        <p class="text-muted">Ver conversaciones</p>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>

    
    
    
    <div id="inboxModal" class="chat-panel">

        <div class="chat-header">
            <h6 id="chatTitle">Conversaciones</h6>
            <button onclick="DocenteMessages.closeInbox()">✖</button>
        </div>

        <div class="chat-body" id="inboxList">
            <div class="empty">Cargando...</div>
        </div>

        <div class="chat-float-button">
            <button onclick="DocenteMessages.nuevaConversacion()">
                ➕ Nueva conversación
            </button>
        </div>

    </div>

    
    
    
    <div id="selectUserModal">

        <div class="chat-header">
            <h6>Seleccionar Usuario</h6>
            <button onclick="DocenteMessages.closeSelectUser()">✖</button>
        </div>

        
        <div class="search-box" style="padding: 15px; border-bottom: 1px solid #ddd;">
            <input type="text" id="searchUserInput" placeholder="🔍 Buscar usuario..."
                onkeyup="DocenteMessages.buscarUsuario()"
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
        </div>

        
        <div class="chat-body" id="usersList" style="overflow-y: auto;">
            <div class="empty">Cargando usuarios...</div>
        </div>

    </div>

    
    
    
    <div id="chatModal">

        <div class="chat-header">
            <h6 id="chatUserTitle">Chat</h6>
            <button onclick="DocenteMessages.closeChat()">✖</button>
        </div>

        <div class="chat-body chat-messages" id="chatMessages"></div>

        <div class="chat-footer">
            <input type="text" id="chatInput" placeholder="Escribe un mensaje...">
            <button onclick="DocenteMessages.sendMessage()">➤</button>
        </div>

    </div>

    <script>
        window.csrfToken = "<?php echo e(csrf_token()); ?>";
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/docentes/messages.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.Docentelanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/Docentes/messages.blade.php ENDPATH**/ ?>