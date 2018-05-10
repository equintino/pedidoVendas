<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatórios</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../web/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src='../web/js/jquery-3.2.1.min.js' ></script>
        <script type="text/javascript" src='../web/js/jquery.dataTables.min.js' ></script>
        <script type='text/javascript'>
            $(document).ready(function(){
                $('#tabela1').DataTable({
                    "order": [[ 3, "desc" ]],
                    "columnDefs": [
                            {
                                "targets": [ 1 ],
                                "visible": true,
                                "searchable": true
                            }
                        ],
                    /*"stateSave": true,*/
                    /*"scroolX": true,*/
                    /*"language": {
                            "decimal": ",",
                            "thousands": "."
                        },*/
                    "language": {
                            "lengthMenu": "Exibir _MENU_ registros por página",
                            "zeroRecords": "Nenhum registro encontrado",
                            "info": "Exibindo pág _PAGE_ de _PAGES_",
                            "infoEmpty": "Nenhum registro disponível",
                            "infoFiltered": "(total de _MAX_ registros)"
                        },
                    "pagingType": "full_numbers",
                });
                $('.tabrel').show();
            });
        </script>
        <style>
            body{
                background: #f4f4f4;
            }
            .tabrel{
                position: relative;
                display: none;
            }
        </style>
    <?php 
        include '../relatorios/menu.php';
    ?>
    </head>
    <body>
    <div class='tabrel'>   
    <table class="display" id='tabela1'>
        <thead><tr><th>Nome</th><th>cpf</th><th>endereco</th><th>sexo</th><th>Valor</th></tr></thead>
        <tbody>
            <tr><td>edmilson</td><td>12345789</td><td>Rua josé</td><td>M</td><td>1.234.567,89</td></tr>
            <tr><td>jorge</td><td>11111111</td><td>Rua andré</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>lucas</td><td>2222222</td><td>Rua marcos</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>gabriel</td><td>3333333</td><td>Rua antônio</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>edmilson</td><td>12345789</td><td>Rua josé</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>jorge</td><td>11111111</td><td>Rua andré</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>lucas</td><td>2222222</td><td>Rua marcos</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>gabriel</td><td>3333333</td><td>Rua antônio</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>edmilson</td><td>12345789</td><td>Rua josé</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>jorge</td><td>11111111</td><td>Rua andré</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>lucas</td><td>2222222</td><td>Rua marcos</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>gabriel</td><td>3333333</td><td>Rua antônio</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>edmilson</td><td>12345789</td><td>Rua josé</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>jorge</td><td>11111111</td><td>Rua andré</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>lucas</td><td>2222222</td><td>Rua marcos</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>gabriel</td><td>3333333</td><td>Rua antônio</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>edmilson</td><td>12345789</td><td>Rua josé</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>jorge</td><td>11111111</td><td>Rua andré</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>lucas</td><td>2222222</td><td>Rua marcos</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>gabriel</td><td>3333333</td><td>Rua antônio</td><td>M</td><td>1234567.89</td></tr>
            <tr><td>mônica</td><td>12345789</td><td>Rua josé</td><td>S</td><td>1234567.89</td></tr>
            <tr><td>marcela</td><td>11111111</td><td>Rua andré</td><td>S</td><td>1234567.89</td></tr>
            <tr><td>vanessa</td><td>2222222</td><td>Rua marcos</td><td>S</td><td>1234567.89</td></tr>
            <tr><td>maria</td><td>3333333</td><td>Rua antônio</td><td>S</td><td>1234567.89</td></tr>
        </tbody>
    </table>
    </div>
    </body>
</html>
