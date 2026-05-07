<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<main>
    <h2>Agenda de Conferencias</h2>
    <p>Bienvenido al evento tecnológico del año. Consulta nuestros talleres y reserva tu plaza.</p>
    
    <!-- Enlace de descarga del programa general -->
    <a href="pdf/programa_general.pdf" class="boton_descarga" download>Descargar Programa General</a>

    <section class="lista-eventos">
        <!-- Esto es "estático" por ahora, luego la Persona 3 lo rellenará con la base de datos -->
        <article class="evento-card" style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
            <h3>Introducción a React y APIs</h3>
            <p><strong>Horario:</strong> 10:00 - 12:00 | <strong>Sala:</strong> Turing</p>
            <p>Aprende las bases del desarrollo web moderno con esta tecnología.</p>
            <a href="detalle_evento.php?id=1">Ver detalles del taller</a>
        </article>
        
        <article class="evento-card" style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
            <h3>Seguridad en Servidores Linux</h3>
            <p><strong>Horario:</strong> 12:30 - 14:00 | <strong>Sala:</strong> 12</p>
            <p>Taller práctico sobre fortificación de servidores.</p>
            <a href="detalle_evento.php?id=2">Ver detalles del taller</a>
        </article>

        <article class="evento-card" style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
            <h3>Charla IoT definitiva</h3>
            <p><strong>Horario:</strong> 16:00 - 18:00 | <strong>Sala:</strong> Salon Conferencias ETSIIT</p>
            <p>Charla detallada sobre el Internet de las Cosas (IoT).</p>
            <a href="detalle_evento.php?id=2">Ver detalles del taller</a>
        </article>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 
