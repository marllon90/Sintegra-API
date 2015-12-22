<?php
class Validator {
	function cnpj($cnpj) {
		$cnpj = preg_replace ( '/[^0-9]/', '', $cnpj );
		
		$cnpj = ( string ) $cnpj;
		
		$cnpjOriginal = $cnpj;
		
		$cnpjNumbers = substr ( $cnpj, 0, 12 );
		function cnpjMultiply($cnpj, $pos = 5) {
			$calc = 0;
			
			for($i = 0; $i < strlen ( $cnpj ); $i ++) {
				
				$calc = $calc + ($cnpj [$i] * $pos);
				
				$pos --;
				
				if ($pos < 2) {
					$pos = 9;
				}
			}
			
			return $calc;
		}
		
		$firstCalc = cnpjMultiply ( $cnpjNumbers );
		
		$firstDigit = ($firstCalc % 11) < 2 ? 0 : 11 - ($firstCalc % 11);
		
		$cnpjNumbers .= $firstDigit;
		
		$secondCalc = cnpjMultiply ( $cnpjNumbers, 6 );
		$secondDigit = ($secondCalc % 11) < 2 ? 0 : 11 - ($secondCalc % 11);
		
		$cnpj = $cnpjNumbers . $secondDigit;
		
		if ($cnpj === $cnpjOriginal) {
			return true;
		}
	}
}