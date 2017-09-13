<?php

	namespace AymericDev\AsyncPHP;

	/**
	* execurt une requette asynchrone en php
	*/
	class AsyncPHP
	{

		private $_url;
		private $_method;
		private $_params;
		private $_query;
		private $_headers;
		private $_buildedHeaders;

		function __construct()
		{
			$this->_url = (isset($_SERVER['HTTPS']) ? "https" : "http")."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
			$this->_method = "POST";
			$this->_params = $_GET;
			$this->_query = "";
			$this->_headers = array("Content-Type", "application/x-www-form-urlencoded");
			$this->_buildedHeaders = [];
		}

		public function setUrl(string $url) {
			$this->_url = $url;
		}

		public function getUrl():string {
			return ($this->_url);
		}

		public function setMethod(string $method) {
			$this->_method = $method;
		}

		public function getMethod():string {
			return ($this->_method);
		}

		public function getHeaders():array {
			return ($this->_headers);
		}

		public function addHeader(string $key, string $value)
		{
			$this->_headers[$key] = $value;
		}

		public function removeHeader(string $key)
		{
			$this->_headers = array_filter(
				$this->_headers,
				function ($k) use ($key) {
					return ($k != $key);
				},
				ARRAY_FILTER_USE_KEY
			);
		}

		public function getParams():array {
			return ($this->_params);
		}

		public function addParam(string $key, string $value)
		{
			$this->_params[$key] = $value;
		}

		public function removeParam(string $key)
		{
			$this->_params = array_filter(
				$this->_params,
				function ($k) use ($key) {
					return ($k != $key);
				},
				ARRAY_FILTER_USE_KEY
			);
		}

		public function run(){
			$this->_buildQuery();
			$this->_buildHeader();
			$this->curlPostAsync();
		}

		private function curlPostAsync(){
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $this->_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_query);

			if ($this->_method == "POST") {
				curl_setopt($ch, CURLOPT_POST, 1);
			}
			elseif ($this->_method != "GET") {
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->_method);
			}

			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 1);

			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_buildedHeaders);

			curl_exec($ch);

			curl_close ($ch);
		}

		private function _buildHeader() {
			$this->_buildedHeaders = [];
			foreach ($this->_headers as $key => $value) {
				$this->_buildedHeaders[] = "$key: $value";
			}
		}

		private function _buildQuery() {
			$this->_query = http_build_query($this->_params);
		}
	}