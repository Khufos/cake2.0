<?php
/**
  * Essa classe contém vários métodos para manipulação de datas.
  * Notando uma grande dificuldade de alguns pragramadores em relação a data no php
  * resolvi constriur essa classe e facilitar a vida dos mesmos.
  * @author Bruno Gonçalves
  * @version 1.0
  * @copyright brunodasg, 2009.
*/ 
class DateHelper extends AppHelper{
	/** 
      * Valida uma data nos formatos dd/mm/yyyy ou yyyy-mm-dd
	  * @param Date $date
      * @return Array
    */ 
	function isValidDate($date){
		# Expressão regular para o fomato 'dd/mm/yyyy'
		$regEx_ptBr = "(0[1-9]{1}|[12][0-9]{2}|3[01]{1})[- /.](0[1-9]|1[012])[- /.](19|20[0-9]{2})";
		# Expressão regular para o fomato 'yyyy-mm-dd'
		$regEx_en = "([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})";

		if(ereg($regEx_ptBr, $date, $arr_date) && checkdate($arr_date[2], $arr_date[1], $arr_date[3])){
			array_shift($arr_date);
			
			return $arr_date;
		}elseif(eregi($regEx_en, $date, $arr_date) && checkdate($arr_date[2], $arr_date[3], $arr_date[2])){
			$arr_result[] = $arr_date[3];
			$arr_result[] = $arr_date[2];
			$arr_result[] = $arr_date[1];

			return $arr_result;
		}else{			
			die("'".$date."' n&atilde;o &eacute; uma data v&aacute;lida.");
		}
	}
	
	
	
	/** 
      * Método calcula o dia da pascoa para qualquer ano apos o ano 1953 com base no calculo do 
	  * astrônomo Jean Baptiste Joseph Delambre
	  * Fonte: http://fabio.freesandbox.net/calculo-do-carnaval-e-da-pascoa/
	  * Disponivel em 26/11/2009
	  * Se não for passado nenhum ano o método vai pegar o ano corrente
	  * @param Integer $year
      * @return Date
    */ 
	function dayOfEaster($year = ""){
		$year = !empty($year) ? $year : date("Y");
		$date = array();
		
		$a = ($year % 19);
		$b = floor($year / 100);
		$c = ($year % 100);
		$d = floor($b / 4);
		$e = ($b % 4);
		$f = floor(($b + 8 ) / 25);
		$g = floor(($b - $f + 1) / 3);
		$h = ((19 * $a + $b - $d - $g + 15) % 30);
		$i = floor($c / 4);
		$k = ($c % 4);
		$l = ((32 + 2 * $e + 2 * $i - $h - $k) % 7);
		$m = floor(($a + 11 * $h + 22 * $l) / 451);
	
		$month = floor(($h + $l - 7 * $m + 114) / 31);
		$day   = ((($h + $l - 7 * $m + 114) % 31) + 1);
		
		$date['day']   = str_pad($day, 2, "0", STR_PAD_LEFT);
		$date['month'] = str_pad($month, 2, "0", STR_PAD_LEFT);
		$date['year']  = $year; 
		
		
		return implode("/", $date);
	}
	
	
	/** 
      * Método retorna um array com todos os feriados nacionais do ano informado sendo a chave dia/mes e o valor a descrição
      * @access public 
	  * @param Integer $year
      * @return Array
    */  
	function getHolidaysNational($year = ""){
		$year = !empty($year) ? $year : date("Y");
		
		# Pega a data da páscoa para poder cálcular os feriados que são baseados nessa data
		$dt_pascoa  = $this->dayOfEaster($year);
		$arr_pascoa = explode("/", $dt_pascoa);				
		# Feriado de carnaval - Reduz-se 47 dias da data da páscoa
		$carnaval       = date("d/m/Y", mktime(0, 0, 0, $arr_pascoa[1], $arr_pascoa[0] - 47, $arr_pascoa[2]));
		# Sexta-feira da paixão - Reduz-se 2 dia da data da páscoa
		$sexta_paixao   = date("d/m/Y", mktime(0, 0, 0, $arr_pascoa[1], $arr_pascoa[0] - 2, $arr_pascoa[2]));
		# Corpus Christi - Acrescenta-se 60 dias na data da páscoa
		$corpus_christi = date("d/m/Y", mktime(0, 0, 0, $arr_pascoa[1], $arr_pascoa[0] + 60, $arr_pascoa[2]));
		
		$arr_carnaval       = explode("/", $carnaval);
		$arr_sexta_paixao   = explode("/", $sexta_paixao);
		$arr_corpus_christi = explode("/", $corpus_christi);
		
		# Criando um array com todos os feriados
		$arr_feriado = array("01/01" => 'Confraterniza&ccedil;&atilde;o Universal',
					 		 $arr_carnaval[0]."/".$arr_carnaval[1] => 'Carnaval',
							 $arr_sexta_paixao[0]."/".$arr_sexta_paixao[1] => 'Paix&atilde;o de Cristo',
							 $arr_pascoa[0]."/".$arr_pascoa[1] => 'P&aacute;scoa',
							 "21/04" => 'Tiradentes',
							 "01/05" => 'Dia do Trabalho',
							 "03/06" => 'Corpus Christi',
							 "07/09" => 'Independ&ecirc;ncia do Brasil',
							 $arr_corpus_christi[0]."/".$arr_corpus_christi[1] => 'Nossa Sra. Aparecida',
							 "02/11" => 'Finados',
							 "15/11" => 'Proclama&ccedil;&atilde;o da Rep&uacute;blica',
							 "25/12" => 'Natal');
							 
		return $arr_feriado;
	}
	
	
	/** 
      * Método verifica se uma data é um dia útil
      * @access public 
	  * @param Date $date
      * @return Boolean
    */  
	function isBusinessDay($date){
		list($day, $month, $year) = $this->isValidDate($date);

		$arr_feriado = $this->getHolidaysNational($year);
  		
  		$date     = mktime(0, 0, 0, $month, $day, $year); 
  		$day_week = date("w", $date);
  
  		# Verifica se o dia  é sábado, domingo e/ou feriado
  		if(($day_week != 0) && ($day_week != 6) && !array_key_exists($day."/".$month, $arr_feriado)){
    		return true;
  		}else{
			return false;
		}
	}
	
	
	/** 
      * Método incrementa um ou mais dias em uma data.
	  * Se o número de dias não for informado será incrementado um dia
      * @access public 
	  * @param Date $date
	  * @param Integer $num_days
      * @return Date
    */  
	function incDay($date, $num_days = 1){
		list($day, $month, $year) = $this->isValidDate($date);
  		
  		$date = date("d/m/Y", mktime(0, 0, 0, $month, ($day + $num_days), $year)); 
			
		return $date;
	}
	
	
	/** 
      * Método decrementa um ou mais dias em uma data.
	  * Se o número de dias não for informado será decrementado um dia
      * @access public 
	  * @param Date $date
	  * @param Integer $num_days
      * @return Date
    */  
	function decDay($date, $num_days = 1){
		list($day, $month, $year) = $this->isValidDate($date);
  		
  		$date = date("d/m/Y", mktime(0, 0, 0, $month, ($day - $num_days), $year)); 
			
		return $date;
	}
	
	
	/** 
      * Método incrementa um ou mais meses em uma data.
	  * Se o número de meses não for informado será incrementado um mês
      * @access public 
	  * @param Date $date
	  * @param Integer $num_month
      * @return Date
    */  
	function incMonth($date, $num_month = 1){
		list($day, $month, $year) = $this->isValidDate($date);
  		
  		$date = date("d/m/Y", mktime(0, 0, 0, ($month + $num_month), $day, $year)); 
			
		return $date;
	}

	/** 
      * Método incrementa um ou mais meses em uma data para o sipa
	  * Se o número de meses não for informado será incrementado um mês
      * @access public 
	  * @param Date $date
	  * @param Integer $num_month
      * @return Date
    */  
	function incMonthSipa($date, $num_month = 1){
		//list($day, $month, $year) = $this->isValidDate($date);
		$data = explode("/",$date);
		$day = $data[0];
		$month = $data[1];
		$year = $data[2];
  		
  		$date = date("d/m/Y", mktime(0, 0, 0, ($month + $num_month), $day, $year)); 
		return $date;
	}
	
	
	/** 
      * Método decrementa um ou mais meses em uma data.
	  * Se o número de meses não for informado será decrementado um mês
      * @access public 
	  * @param Date $date
	  * @param Integer $num_month
      * @return Date
    */  
	function decMonth($date, $num_month = 1){
		list($day, $month, $year) = $this->isValidDate($date);
  		
  		$date = date("d/m/Y", mktime(0, 0, 0, ($month - $num_month), $day, $year)); 
			
		return $date;
	}
	
	
	/** 
      * Método incrementa um ou mais anos em uma data.
	  * Se o número de anos não for informado será incrementado um ano
	  * Alterado por Daniele Souza em 21/09/2020
      * @access public 
	  * @param Date $date
	  * @param Integer $num_year
      * @return Date
    */  
	function incYear($date, $num_year = 1){
		list($day, $month, $year) = $this->isValidDate($date);

  		
  		$date = date("d/m/Y", mktime(0, 0, 0, $month, $day, ($year + $num_year))); 
			
		return $date;
	}


	/** 
      * Método incrementa um ou mais anos em uma data para o sipa.
	  * Se o número de anos não for informado será incrementado um ano
	  * Alterado por Daniele Souza em 21/09/2020
      * @access public 
	  * @param Date $date
	  * @param Integer $num_year
      * @return Date
    */  
	function incYearSipa($date, $num_year = 1){
		$data = explode("/",$date);
		$day = $data[0];
		$month = $data[1];
		$year = $data[2];

  		
  		$date = date("d/m/Y", mktime(0, 0, 0, $month, $day, ($year + $num_year))); 
			
		return $date;
	}
	
	/** 
      * Método decrementa um ou mais anos em uma data.
	  * Se o número de anos não for informado será decrementado um ano
      * @access public 
	  * @param Date $date
	  * @param Integer $num_year
      * @return Date
    */  
	function decYear($date, $num_year = 1){
		list($day, $month, $year) = $this->isValidDate($date);
  		
  		$date = date("d/m/Y", mktime(0, 0, 0, $month, $day, ($year - $num_year))); 
			
		return $date;
	}
	
	
	/** 
      * Método retorna o dia da semana por extenso.
	  * Sendo 0 equivalente a domingo e 6 ao sábado
      * @access public 
	  * @param Integer $day
      * @return String
    */  
	function dayOfWeek($day = ""){
		$day = !empty($day) ? $day : date("w");
		$arr_days_week = array(0 => 'domingo', 'segunda-feira', 'ter&ccedil;a-feira', 'quarta-feira', 'quinta-feira', 
							   'sexta-feira', 's&aacute;bado');
		
		return $arr_days_week[$day];
	}
	
	
	/** 
      * Método retorna o mês por extenso.
	  * Se o segundo parâmetro opcional for verdadeiro. Será retornado o mês de forma abreviada.
      * @access public 
	  * @param Integer $iMonth
	  * @param Boolean $abbreviated
      * @return String
    */ 
	function monthSpelled($iMonth = "", $abbreviated = false){
		$iMonth = !empty($iMonth) ? $iMonth : date("n");
		$arr_month = array(1 => 'Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 
						   'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
		
		return ($abbreviated) ? substr($arr_month[intval($iMonth)], 0, 3) : $arr_month[intval($iMonth)];
	}
	
	
	/** 
      * Método calcula a diferença de dias entre duas datas
      * @access public 
	  * @param Date $date_of
	  * @param Date $date_to
      * @return Integer
    */ 
	function dateDiff($date_of, $date_to){  
  		list($day_of, $month_of, $year_of) = $this->isValidDate($date);
		list($day_to, $month_to, $year_to) = $this->isValidDate($date);
          
  		$date_of = mktime(0, 0, 0, $month_of, $day_of, $year_of); 
  		$date_to = mktime(0, 0, 0, $month_to, $day_to, $year_to); 
          
  		$days = ($date_to - $date_of) / 86400; 

  		return ceil($days); 
	}
	
	
	/** 
      * Método retorna o mktime de uma data
      * @access public 
	  * @param Date $date
      * @return Integer
    */ 
	function getMktime($date){  
  		list($day, $month, $year) = $this->isValidDate($date);

  		return mktime(0, 0, 0, intval($month), intval($day), intval($year)); 
	}
	
	
	/** 
      * Método verifica se um determinado ano é bissexto ou não
      * @access public 
	  * @param Char $year
      * @return Boolean
    */ 
	function isLeapYear($year){ 
  		return date("L", mktime(0, 0, 0, date("m"), date("d"), $year));
	}
	
	
	/** 
      * Método retorna o dia do ano para uma data
	  * Entre 1 e 367
      * @access public 
	  * @param Date $date
      * @return Integer
    */ 
	function dayOfYear($date){ 
		list($day, $month, $year) = $this->isValidDate($date);
		$day = date("z", mktime(0, 0, 0, $month, $day, $year)) + 1;
		
  		return $day;
	}
	
	
	/** 
      * Método retorna o dia de uma data
      * @access public 
	  * @param Date $date
      * @return Integer
    */ 
	function getDay($date){ 
		list($day, $month, $year) = $this->isValidDate($date);
		
  		return $day;
	}
	
	
	/** 
      * Método retorna o mês de uma data
      * @access public 
	  * @param Date $date
      * @return Integer
    */ 
	function getMonth($date){ 
		list($day, $month, $year) = $this->isValidDate($date);
		
  		return $month;
	}
	
	
	/** 
      * Método retorna o ano de uma data
      * @access public 
	  * @param Date $date
      * @return Integer
    */ 
	function getYear($date){ 
		list($day, $month, $year) = $this->isValidDate($date);
		
  		return $year;
	}
}
?>