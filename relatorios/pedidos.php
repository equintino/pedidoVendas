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
            });
        </script>
        <?php
        include "menu.php";
        ?>
        <style type="text/css">
        #principal {
            margin: auto;
            margin-top: 50px;
            width: 900px;
            }

        #tabela1 {
           font-family: Verdana, Geneva, Tahoma, sans-serif;
            }

        thead tr{
            background: rgb(38, 93, 141);
            }
        </style>
    </head>
    <body>
    <div id="principal">
    <table class="display" id='tabela1'>
        <thead><tr><th>Vendedor</th><th>Cliente</th><th>Produto</th><th>QT.</th><th>Valor Tot.</th></tr></thead>
        <tbody>
            <tr><td>lucas</td><td>jorge</td><td>Mouse C3Tech</td><td>1</td><td>1.234.567,89</td></tr>
            <tr><td>karen</td><td>clayton</td><td>Teclado Logitech</td><td>1</td><td>1234567.89</td></tr>
            <tr><td>mônica</td><td>bruno</td><td>Mousepad</td><td>1</td><td>1234567.89</td></tr>
            <tr><td>gabriel</td><td>Henrique</td><td>Careegador PC-V8</td><td>1</td><td>1234567.89</td></tr>
            <tr><td>edmilson</td><td>Glaucio</td><td>Mouse C3Tech</td><td>1</td><td>1234567.89</td></tr>
            <tr><td>jorge</td><td>Maria</td><td>Teclado Logitech</td><td>1</td><td>1234567.89</td></tr>
            <tr><td>João</td><td>bruno</td><td>Fone Exbom</td><td>1</td><td>1234567.89</td></tr>
            <tr><td>gabriel</td><td>Henrique</td><td>Careegador PC-V8</td><td>1</td><td>1234567.89</td></tr>
            <tr><td>Inês</td><td>Glaucio</td><td>Caixa de Som Knup</td><td>2</td><td>1234567.89</td></tr>
            <tr><td>jorge</td><td>clayton</td><td>Mouse C3Tech</td><td>2</td><td>1234567.89</td></tr>
            <tr><td>lucas</td><td>bruno</td><td>Fone Exbom</td><td>2</td><td>1234567.89</td></tr>
            <tr><td>Marcos</td><td>Henrique</td><td>Pen Drive Kingston</td><td>3</td><td>1234567.89</td></tr>
            <tr><td>Inês</td><td>Glaucio</td><td>Gabinete c3Tech</td><td>2</td><td>1234567.89</td></tr>
            <tr><td>jorge</td><td>clayton</td><td>Mouse C3Tech</td><td>2</td><td>1234567.89</td></tr>
            <tr><td>lucas</td><td>Cleber</td><td>Fone Exbom</td><td>1</td><td>1234567.89</td></tr>
            <tr><td>gabriel</td><td>Luiz</td><td>Pen Drive Kingston</td><td>2</td><td>1234567.89</td></tr>
            <tr><td>edmilson</td><td>vander</td><td>Caixa de Som Knup</td><td>2</td><td>1234567.89</td></tr>
            <tr><td>jorge</td><td>Maria</td><td>Teclado Logitech</td><td>2</td><td>1234567.89</td></tr>
            <tr><td>João</td><td>Cleber</td><td>Fone Exbom</td><td>2</td><td>1234567.89</td></tr>
            <tr><td>Marcos</td><td>Luiz</td><td>Pen Drive Kingston</td><td>1</td><td>1234567.89</td></tr>
            <tr><td>mônica</td><td>vander</td><td>Caixa de Som Knup</td><td>3</td><td>1234567.89</td></tr>
            <tr><td>marcela</td><td>Maria</td><td>Fonte Real 600cx</td><td>3</td><td>1234567.89</td></tr>
            <tr><td>vanessa</td><td>Cleber</td><td>Fonte Notebook asus</td><td>3</td><td>1234567.89</td></tr>
            <tr><td>maria</td><td>Luiz</td><td>CD-ROM</td><td>3</td><td>1234567.89</td></tr>
        </tbody>
    </table>
    </div>
    
    </body>
</html>
