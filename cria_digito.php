function validar_cnpj($cnpj)
{
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

    // VERIFICA O TAMANHO DO CNPJ
    if (strlen($cnpj) != 12)
        return false;
    // VERIFICA SE OS ALGORISMOS SAO IGUAIS EX '000000000000'
    if (preg_match('/(\d)\1{12}/', $cnpj))
        return false;	

    // CRIA O PRIMEIRO DIGITO VERIFICADOR
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
    {
        $soma += $cnpj{$i} * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    $cnpj{12} = $resto < 2 ? 0 : 11 - $resto;

    // CRIA O SEGUNDO DIGITO VERIFICADOR
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
    {
        $soma += $cnpj{$i} * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    $cnpj{13} = $resto < 2 ? 0 : 11 - $resto;

    print_r($cnpj);
}

$val = validar_cnpj('09.524.502/0001');
echo "seu cnpj é:".$val;
