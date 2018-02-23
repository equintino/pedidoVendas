<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('button').click(function(){
            alert('Obrigado por ter usado o sistema.');
            window.close('#');
        });
    })
    function close_window() {
        alert('vai fechar.');
        close();
    }
</script>
<body onload = "setTimeout('window.close()',50000)">
<?php
   include '../validacao/valida_cookies.php';
    $cookies=new valida_cookies();
    $cookies->limpaCookies();
    //header("Location:../index.html");
?>
<button onclick="close_window()">Fecha</button>