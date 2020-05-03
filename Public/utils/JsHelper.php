<?php
namespace Utils;

class JsHelper {
	public static function jsEncode($array) {
		echo "JSON.parse('" . json_encode($array) . "')";
	}
}