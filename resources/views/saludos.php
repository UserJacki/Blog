<!DOCTYPE HTML>
<HTML lang="en">
    <HEAD>
        <meta charset="UTF-8">
        <TITLE>LARAVEL</TITLE>
    </HEAD>
    <BODY>
        <?php $nombre="<strong>Daniel</strong>" ?>  <!-- declarar variables con php en una vista sin el blade-->
        <!--<P>¡Hola mundo con PHP!</p> -->
        <P>
            <?php
                echo $nombre;
            ?>
         </p>
    </BODY>
</HTML>
