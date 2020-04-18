<?php
namespace Utils;

class JsHelper {
	public function jsEncode($array) {
		echo "JSON.parse('" . json_encode($array) . "')";
	}
}