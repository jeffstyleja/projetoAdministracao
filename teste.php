<?php













function ordenaArray($array)
{
    $arr = $array;
    $kvalue = array_count_values($arr); // Função conta o numero de repetição de valores dentro do array , as repetições viram chave
    asort($kvalue); // Ordenei as chaves pelo numero de repetições de forma crescente;
    $key = array_keys($kvalue); // Peguei os valores da chave para utilizar na montagem do array novo;

    // pego os valores das repetições
    foreach ($kvalue as $v) {
        $value[] = $v;
    }

    //Logica para montagem do array de saida, primeiro conto o array no for
    for ($d = 0; $d < count($key); $d++) {
        if ($value[$d] == 1) { // Se o valor da repetição for 1 então ordenaremos os valores do array de forma crescente
            $saida1[] = $key[$d]; //insiro o elemento no novo array
            sort($saida1); // Ordenando array sem repetição
        } else {
            for ($i = 0; $i < $value[$d]; $i++) {// inserindo elementos que possuem mais de uma repetição
                $saida2[] = $key[$d];
                sort($saida2);// Ordenando array com repetição
            }
        }
    }
    $saida = array_merge($saida1,$saida2); ;//Mergiando array
    var_dump($saida);
}

$teste = array(8, 5, 5, 5, 5, 1, 1, 1, 4, 4);
ordenaArray($teste);

$teste = array(3,1,8,8,2,2,4);
ordenaArray($teste);

?>
