<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Calendário PHP</title>
</head>
<body>
<?php
date_default_timezone_set("America/Sao_Paulo");

function diaExato() {
    return date('d');
}

function mesExato() {
    return date('m');
}

function linha($semana, $mesAtual){
    $linha = '<tr>';
    $diaHoje = diaExato();
    $mesHoje = mesExato();

    for($i = 0; $i <= 6; $i++) {
        if (array_key_exists($i, $semana)){
            $class = ($i == 0) ? 'sunday' : ''; 
            if ($semana[$i] == $diaHoje && $mesAtual == $mesHoje) {
                $class .= ' today';
            }

            $linha .= "<td class='{$class}'>{$semana[$i]}</td>";
        } else {
            $linha .= "<td></td>";
        }
    }

    $linha .= "</tr>";
    return $linha;
}

function calendarioMes($mes, $ano){
    $calendario = "";
    $dia = 1;

    $primeiroDiaSemana = date('w', strtotime("$ano-$mes-01"));
    $numeroDeDias = date('t', strtotime("$ano-$mes-01"));

    $semana = array_fill(0, $primeiroDiaSemana, ''); 

    while($dia <= $numeroDeDias) {
        $semana[] = $dia;

        if (count($semana) == 7){
            $calendario .= linha($semana, $mes);        
            $semana = [];
        }
        $dia++;
    }

    if (count($semana) > 0) {
        $calendario .= linha($semana, $mes); 
    }

    return $calendario;
}

function calendarioAno($ano) {
    $meses = [
        1 => 'Janeiro', 
        2 => 'Fevereiro', 
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio', 
        6 => 'Junho', 
        7 => 'Julho', 
        8 => 'Agosto',
        9 => 'Setembro', 
        10 => 'Outubro', 
        11 => 'Novembro', 
        12 => 'Dezembro'
    ];

    $calendarios = "";

    foreach ($meses as $mes => $nomeMes) {
        $calendarios .= "<h3>{$nomeMes} - {$ano}</h3>";
        $calendarios .= "<table border='1'>
            <thead>
                <tr>
                    <th class='sunday'>Dom</th>
                    <th>Seg</th>
                    <th>Ter</th>
                    <th>Qua</th>
                    <th>Qui</th>
                    <th>Sex</th>
                    <th>Sáb</th>
                </tr>
            </thead>
            <td>" . calendarioMes($mes, $ano) . "</td>
        </table>";
    }

    return $calendarios;
}

$anoAtual = date('Y');
?>

    <h1>Calendário de <?php echo $anoAtual; ?></h1>

    <?php echo calendarioAno($anoAtual); ?>

</body>
</html>
