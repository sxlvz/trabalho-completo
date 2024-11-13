<?php
if (ob_get_level() > 0) { // Verifica se um buffer está ativo
    ob_end_flush(); // Envia o conteúdo do buffer e finaliza
}
?>
</body>
</html>