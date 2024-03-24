<?php

/**
 * Essa classe contém vários métodos para manipulação de datas.
 * @author Jailson Boa Morte
 * @version 1.0
 * @copyright Jailson Boa Morte, 2010.
 */
class UtilHelper extends AppHelper {

    /**
     * @abstract recebe e formata data em dd/mm/yyyy
     * @param Data no formato yyyy-mm-dd
     * @return Date no formato dd/mm/yyyy
     */
    function ddmmaa($Cdata) {  //recebe yyyy-mm-dd e formata data em dd/mm/yyyy
        $Cdata = trim($Cdata); // remove espaços
        $array = explode('-', $Cdata); // fragmenta a data

        if (count($array) == 3) { // tres posicoes
            $Cdata = implode('/', array_reverse($array));
        }

        return $Cdata;
    }

	/**
     * @abstract recebe e formata data em dd/mm/yyyy His
     * @param Data no formato yyyy-mm-dd his
     * @return Date no formato dd/mm/yyyy his
     */
    function ddmmaaHis($Cdata) {
    	if (strlen($Cdata) > 0) {
			list($data, $hora) = explode(' ', $Cdata);

			$data = implode('/', array_reverse(explode('-', $data))) . ' ' . $hora;

			return $data;
		}
		return "";
    }

    	/**
     * @abstract recebe e formata data em yyyy-mm-dd His
     * @param Data no formato yyyy-mm-dd his
     * @return Date no formato dd/mm/yyyy 
     */
    function ddmmaa2($Cdata) {
        // Convert the timestamp to a UNIX timestamp
        $timestamp_unix = strtotime($Cdata);

        // Convert to the desired format "DD-MM-YYYY"
        $desired_format = date('d-m-Y', $timestamp_unix);
		return $desired_format;
    }

    /**
     * @abstract recebe e formata data em yyyy-mm-dd
     * @param Data no formato  dd/mm/yyyy
     * @return Date no formato yyyy-mm-dd
     */
    function aammdd($Cdata) {  //recebe dd-mm-yyyy e formata data em yyyy-mm-dd
        $Cdata = trim($Cdata); // remove espaços
        $array = explode('/', $Cdata); // fragmenta a data

        if (count($array) == 3) { // tres posicoes
            $Cdata = implode('-', array_reverse($array));
        }

        return $Cdata;
    }

    function aammddHis($timestamp) {
        //FireCake::info($timestamp,"timestamp");
        $vetData = explode(" ", $timestamp);
        //FireCake::info($vetData,"vetData");
        if (!empty($vetData[0])) {
            $data = $this->ddmmaa($vetData[0]);
            return $data . " " . $vetData[1];
        } else {
            return false;
        }
    }

    function somarData($data, $sinal, $dias) {
        $dataS = explode("-", $data);
        // $date = new DateTime($data);
        if ($sinal == "+") {
            $date = mktime(0, 0, 0, $dataS[1], $dataS[2] + $dias, $dataS[0]);
            // date_add($date, new DateInterval("P".$dias."D"));
        } elseif ($sinal == "-") {
            $date = mktime(0, 0, 0, $dataS[1], $dataS[2] - $dias, $dataS[0]);
            // date_sub($date, new DateInterval("P".$dias."D"));
        }
        return date('Y-m-d', $date);
        //FireCake::info($res,'res');
    }

    function compararDatas($data1, $data2, $sinal) {
        $retorno = false;

        if ($sinal == ">") {
            if ($data1 > $data2) {
                $retorno = true;
            }
        } elseif ($sinal == "<") {
            if ($data1 < $data2) {
                $retorno = true;
            }
        } elseif ($sinal == "=") {
            if ($data1 == $data2) {
                $retorno = true;
            }
        } elseif ($sinal == ">=") {
            if ($data1 >= $data2) {
                $retorno = true;
            }
        } elseif ($sinal == "<=") {
            if ($data1 <= $data2) {
                $retorno = true;
            }
        }

        return $retorno;
    }

    function setaValorPadrao(&$variavel, $padrao = "ND") {
        $variavel = isset($variavel) ? $variavel : $padrao;
        $variavel = !empty($variavel) ? $variavel : $padrao;
        return $variavel;
    }

    function __($string){

        $traducao = array(
            'edit' => 'Editar',
            'add' => 'Incluir',
            'acao' => 'Ação',
            'add agendamento' => 'Agendar', // Avaliar
            'extrato assistido' => 'Exibir Extrato',
            'juizado_especial_civel' => 'Ação',
            'senha_servidor_especifico' => 'Emitir senha para um servidor específico',
            'agendamento_servidor' => 'Agendar para servidor(a)',
            'emitirSenha' => 'Emitir senha'
        );

        if(isset($traducao[$string]))
            return $traducao[$string];

        $stringArray = explode(" ", $string);
        foreach ($stringArray as $key => $value) {
            if( isset($traducao[$value]) )
                $stringArray[$key] = $traducao[$value];
        }


        return ucwords(implode(" ", $stringArray));

    }

    /**
     * @author Diego Alex
     *
     */
    function buscaNomeMes($m) {

        switch (date("m")) {
            case "01": $mes = 'Janeiro';
                break;
            case "02": $mes = 'Fevereiro';
                break;
            case "03": $mes = 'Março';
                break;
            case "04": $mes = 'Abril';
                break;
            case "05": $mes = 'Maio';
                break;
            case "06": $mes = 'Junho';
                break;
            case "07": $mes = 'Julho';
                break;
            case "08": $mes = 'Agosto';
                break;
            case "09": $mes = 'Setembro';
                break;
            case "10": $mes = 'Outubro';
                break;
            case "11": $mes = 'Novembro';
                break;
            case "12": $mes = 'Dezembro';
                break;
        }

        return $mes;
    }

    /**
     * @author Jailson Boa Morte
     * @deprecated Recebe uma string e retorno com a primeira letra de cada palavra em Maisculo
     * @param $string String String a ser convertida
     * @param $excecao Array Lista de String que não será convertida
     * @return String String Convertida
     */
    function primeiraMaiscula($string, $excecao) {

        // Converte strings para Iniciais mai�sculas
        // N�o converte "da,do,dos,das,de ..." nomes no meio iniciando do D com 2 ou 3 letras

        if ($string == "")
            return $string;

        $string = utf8_encode(strtolower(utf8_decode($string)));

        $string = ucwords($string);
        $pattern = '/([\ ]+[A-Za-z]{0,3}+[\ ])/e';
        $replacement = "strtolower('$1')";
        $string = preg_replace($pattern, $replacement, $string);

        foreach ($excecao as $key => $value) {
            $string = str_replace($key, strtolower($value), $string);
        }

        return $string;
    }

    /**
     * @author Esiquiel Pedro
     * @abstract Recebe uma data no formato americano e realiza a diferença entre elas em dias (D)
     * @var Date $d1
     * @var Date $d2
     * @return Date $diff
     */
    function diffDate($d1, $d2) {
        if (empty($d1) || empty($d2) || $d1 == "0000-00-00" || $d2 == "0000-00-00") {
            $retorno = 0;
        } else {
            // D1
            $ano_banco = substr($d1, 0, 4);
            $mes_banco = substr($d1, 5, 2);
            $dia_banco = substr($d1, 8, 2);
            $data1 = $dia_banco . "-" . $mes_banco . "-" . $ano_banco;

            // D2
            $ano_atual = substr($d2, 0, 4);
            $mes_atual = substr($d2, 5, 2);
            $dia_atual = substr($d2, 8, 2);
            $data2 = $dia_atual . "-" . $mes_atual . "-" . $ano_atual;

            $data1 = mktime(0, 0, 0, $mes_banco, $dia_banco, $ano_banco);
            $data2 = mktime(0, 0, 0, $mes_atual, $dia_atual, $ano_atual);
            $dias = ($data1 - $data2) / 86400;
            $dias = ceil($dias);
            $retorno = $dias;
        }

        return $retorno;
    }

    /**
     * @param Array $elementos
     * @param Int $tam Tamanho máximo dos valores do array
     * @author Jailson Boa Morte
     * @abstract Re
     */
    function reduzDescricaoArray($elementos, $tam) {
        foreach ($elementos as $id => $elemento) {
            $nome = $elemento;
            $nome = (strlen($nome) > $tam) ? substr($nome, 0, $tam) . '...' : $nome;
            $elementos[$id] = $nome;
        }

        return $elementos;
    }

    function diaSemana($posDiaSemana, $posDia, $data) {
        $difdias = $posDiaSemana - $posDia;
        $dataS = explode("-", $data);
        if ($difdias < 0) { // somar
            $difdias = abs($difdias);
            $date = mktime(0, 0, 0, $dataS[1], $dataS[2] + $difdias, $dataS[0]);
        } else { //diminuir
            $date = mktime(0, 0, 0, $dataS[1], $dataS[2] - $difdias, $dataS[0]);
        }

        return date('Y-m-d', $date);
    }

    // Transforma numero inteiro em data e hora.
    function intToTime($data) {

        $dData = substr($data, 0, 2);
        $mData = substr($data, 2, 2);
        $aData = substr($data, 4, 4);
        $hData = substr($data, 8, 2);
        $minData = substr($data, 10, 2);
        $segData = substr($data, 12, 2);
        $dados = ($dData . '/' . $mData . '/' . $aData . ' ' . $hData . ':' . $minData . ':' . $segData);


        return $dados;
    }

    //transforma numero inteiro em data.
    function intToDate($data) {

        $dData = substr($data, 0, 2);
        $mData = substr($data, 2, 2);
        $aData = substr($data, 4, 4);

        $dados = ($dData . '/' . $mData . '/' . $aData);
        return $dados;
    }

    /**
     * @author Diego Alex
     * @abstract Recebe duas datas(AAAA-MM-DD) e retorna a diferença entre elas em anos, meses e dias
     * @var Date $d1
     * @var Date $d2
     * @return Date $diferenca
     */
    function difDatasDMA($databd1, $databd2) {
        $retorno = array('a' => 0, 'm' => 0, 'd' => 0);
        if (!(empty($databd1) || empty($databd2) || $databd1 == "0000-00-00" || $databd2 == "0000-00-00")) {

            $data1 = explode("-", $databd1);
            $data2 = explode("-", $databd2);

            $ano = $data2[0] - $data1[0];
            $mes = $data2[1] - $data1[1];
            $dia = $data2[2] - $data1[2];

            if ($mes < 0) {
                $ano--;
                $mes = 12 + $mes;
            }
            if ($dia < 0) {
                $mes--;
                $dia = 30 + $dia;
            }

            $retorno['d'] = $dia;
            $retorno['m'] = $mes;
            $retorno['a'] = $ano;
        }

        return $retorno;
    }

    function formataParaDMA($dma) {
        return $dma['a'] . "a" . $dma['m'] . 'm' . $dma['d'] . "d";
    }

    function somarDMA($dt1, $dt2) {

        $qtdDM = 30; // quantidade de dias no mesm

        $d = $dt1['d'] + $dt2['d'];  // soma os dias
        $m = $dt1['m'] + $dt2['m']; // soma os meses
        $a = $dt1['a'] + $dt2['a'];  // soma os anos


        $qtdD = floor($d % $qtdDM);
        $m += floor($d / $qtdDM);

        $d = $qtdD;

        $qtdM = floor($m % 12);
        $a+= floor($m / 12);

        $retorno = array('a' => $a, 'm' => $qtdM, 'd' => $d);

        return $retorno;
    }

    /**
     * @param type $dt1
     * @param type $dt2
     * @return Array
     * @author Jailson Boa Morte
     */
    function subtrairDMA($dt1, $dt2) {
        $qtdDM = 30; // quantidade de dias no mesm
        $qtdDA = 360; // quantidade de dias no Ano

        $d = $dt1['d'] + $dt2['d'];  // soma os dias
        $m = $dt1['m'] + $dt2['m']; // soma os meses
        $a = $dt1['a'] + $dt2['a'];  // soma os anos
        //
        #converte para dias
        $ttDias1 = $dt1['a'] * $qtdDA + $dt1['m'] * $qtdDM + $dt1['d'];
        $ttDias2 = $dt2['a'] * $qtdDA + $dt2['m'] * $qtdDM + $dt2['d'];

        $difDMA = $ttDias1 - $ttDias2;
        if ($difDMA > 0) { // dt1 maior que dt2
            $a = floor($difDMA / $qtdDA); // quantidade de anos
            $resA = ($difDMA % $qtdDA); // sobra da divisão anual

            $m = floor($resA / $qtdDM); // quantidade de meses

            $d = floor($resA % $qtdDM); // quantidade de meses

            $retorno = array('a' => $a, 'm' => $m, 'd' => $d);
        } else {  // dt2 inferior  a dt1
            $retorno = array('a' => 0, 'm' => 0, 'd' => 0);
        }

        return $retorno;
    }

    /**
     * @param date $data data base para calculo
     * @param Array $dma  dia mes ano
     * @return DATE
     * @author Jailson Boa Morte
     */
    function somarDMAaData($data, $dma) {
        $dt = explode('-', $data);

        return date('Y-m-d', mktime(0, 0, 0, $dt[1] + $dma['m'], $dt[2] + $dma['d'], $dt[0] + $dma['a']));
    }

    /**
     * @param date $data data base para calculo
     * @param Array $dma  dia mes ano
     * @return DATE
     * @author Jailson Boa Morte
     */
    function subtrairDMAaData($data, $dma) {
        $dt = explode('-', $data);

        return date('Y-m-d', mktime(0, 0, 0, $dt[1] - $dma['m'], $dt[2] - $dma['d'], $dt[0] - $dma['a']));
    }

    /**
     *
     * @param INT $qtd
     * @param CHAR $tipo Tipo de quantidade m: Mês a: Ano
     * @abstract Convert para dias de acordo com o tipo
     * @author Jailson Boa Morte
     * @return INT
     */
    function converteparaDias($qtd, $tipo) {
        $retorno = 0;
        $qtdDM = 30;
        $qtdDA = 360; // quantidade de dias no Ano
        if ($tipo == 'm') { // converte meses para dia
            $retorno = $qtd * $qtdDM;
        } elseif ($tipo == 'a') { // converte anos para dia
            $retorno = $qtd * $qtdDA;
        }

        return $retorno;
    }

    function converteDMAparaDias($dma) {
        $a = $dma['a'];
        $m = $dma['m'];
        $d = $dma['d'];

        $d+=$this->converteparaDias($m, 'm');
        $d+=$this->converteparaDias($a, 'a');

        return $d;
    }

    /**
     *
     * @author Jailson Boa Morte
     * @param INT $qtd Quantidade de Dias
     * @abstract Convert para formato de pena amd
     * @return Array
     */
    function converteParaDMA($qtd) {
        $retorno = array('a' => 0, 'm' => 0, 'd' => 0);
        $dvdd = $qtd;
        $qtdDM = 30; // quantidade de dias no mesm
        $qtdDA = 360; // quantidade de dias no Ano

        if ($dvdd <= $qtdDM) { // dias
            $retorno['d'] = $dvdd;
        }

        while ($dvdd > $qtdDM) { // enquato a divisão não chegar em dias
            if ($dvdd > 365) { // anos
                $csc = floor($dvdd / $qtdDA);
                $dvdd = $dvdd - ($csc * $qtdDA);
                $retorno['a'] = $csc;
            } elseif ($dvdd > $qtdDM) { // meses
                $csc = floor($dvdd / $qtdDM);
                $rest = floor($dvdd % $qtdDM);
                $dvdd = $dvdd - ($csc * $qtdDM);
                $retorno['m'] = $csc;
                $retorno['d'] = $rest;
            }
        }

        return $retorno;
    }
    
    function corExecPenal($nome = null, $idSituacao = null){
        
        $cor['link'] = ''; 
        $cor['cor'] = 'background-color: #99CC99;';
        
        if($idSituacao == 92)
            $cor['cor'] = 'background-color: #9F5F9F;'; 
        elseif($idSituacao == 94){
            $cor['cor'] = 'background-color: #215E21; color: #FFF;';
            $cor['link'] = 'color: #d0d6b1;';
        }
        elseif($idSituacao == 104){
            $cor['cor'] = 'background-color: #545454; color: #FFF;';
            $cor['link'] = 'color: #d0d6b1;';
        }
        elseif($idSituacao == 90){
            $cor['cor'] = 'background-color: #0000FF;  color: #FFF;';
            $cor['link'] = 'color: #d0d6b1;';
        }
        elseif($idSituacao == 93)
            $cor['cor'] = 'background-color: #00FF00;';
        elseif($idSituacao == 91)
            $cor['cor'] = 'background-color: #FF0000;';
        elseif($idSituacao == 87)
            $cor['cor'] = 'background-color: #FFFF00;';
        elseif($idSituacao == 105)
            $cor['cor'] = 'background-color: #FFF;';
        elseif($idSituacao == 112)
            $cor['cor'] = 'background-color: #FF00FF;';
        elseif($idSituacao == 106){
            $cor['cor'] = 'background-color: #000; color: #FFF;';
            $cor['link'] = 'color: #d0d6b1;';
        }
        else
            $cor['cor'] = 'background-color: #99CC99;';
        return $cor;
    }


	public static function getUFArray() {
		return array(
			'AC' => 'AC',
			'AL' => 'AL',
			'AM' => 'AM',
			'AP' => 'AP',
			'BA' => 'BA',
			'CE' => 'CE',
			'DF' => 'DF',
			'ES' => 'ES',
			'GO' => 'GO',
			'MA' => 'MA',
			'MT' => 'MT',
			'MS' => 'MS',
			'MG' => 'MG',
			'PA' => 'PA',
			'PB' => 'PB',
			'PR' => 'PR',
			'PE' => 'PE',
			'PI' => 'PI',
			'RJ' => 'RJ',
			'RN' => 'RN',
			'RO' => 'RO',
			'RS' => 'RS',
			'RR' => 'RR',
			'SC' => 'SC',
			'SE' => 'SE',
			'SP' => 'SP',
			'TO' => 'TO'
		);
	}
}

