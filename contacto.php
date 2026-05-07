<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<main>
    <section class="seccion_contacto">
        <h2>Contacto y Desarrolladores</h2>
        
        <div class="developer_info">
            <h3>Equipo de Desarrollo</h3>
            <p>Este proyecto ha sido desarrollado para la asignatura de Tecnologías Web por:</p>
            <ul>
                <li><strong>Guillermo Martín Sánchez:</strong> Estructura Base, Estilos y Vista Pública.</li>
                <li><strong>Javier Rivera Delgado:</strong> Requisitos Dinámicos y Sesiones.</li>
                <li><strong>Diego Romero Fuentes:</strong> Base de Datos y Gestión de Eventos.</li>
            </ul>
        </div>

        <hr class="separador">

        <div class="formulario_contacto">
            <h3>Envíanos un mensaje</h3>
            <form action="#" method="POST">
                <div class="campo">
                    <label for="nombre">Nombre completo:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ej: Juan Pérez" required>
                </div>

                <div class="campo">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="usuario@ejemplo.com" required>
                </div>

                <div class="campo">
                    <label for="asunto">Asunto:</label>
                    <select id="asunto" name="asunto" required>
                        <option value="">Selecciona una opción</option>
                        <option value="duda">Duda sobre un evento</option>
                        <option value="problema">Problema con la inscripción</option>
                        <option value="sugerencia">Sugerencia</option>
                    </select>
                </div>

                <div class="campo">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" rows="5" placeholder="Escribe aquí tu consulta..." required></textarea>
                </div>

                <div class="zona_boton">
                    <button type="submit" class="btn_principal">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 
