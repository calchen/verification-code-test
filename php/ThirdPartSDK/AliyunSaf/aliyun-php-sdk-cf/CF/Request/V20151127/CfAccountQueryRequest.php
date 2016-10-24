<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
namespace CF\Request\V20151127;

class CfAccountQueryRequest extends \RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("CF", "2015-11-27", "CfAccountQuery");
		$this->setProtocol("https");
	}

	private  $appKey;

	private  $sceneId;

	private  $ip;

	private  $phoneNumber;

	private  $trans;

	private  $cFTimestamp;

	private  $appToken;

	public function getAppKey() {
		return $this->appKey;
	}

	public function setAppKey($appKey) {
		$this->appKey = $appKey;
		$this->queryParameters["AppKey"]=$appKey;
	}

	public function getSceneId() {
		return $this->sceneId;
	}

	public function setSceneId($sceneId) {
		$this->sceneId = $sceneId;
		$this->queryParameters["SceneId"]=$sceneId;
	}

	public function getIp() {
		return $this->ip;
	}

	public function setIp($ip) {
		$this->ip = $ip;
		$this->queryParameters["Ip"]=$ip;
	}

	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
		$this->queryParameters["PhoneNumber"]=$phoneNumber;
	}

	public function getTrans() {
		return $this->trans;
	}

	public function setTrans($trans) {
		$this->trans = $trans;
		$this->queryParameters["Trans"]=$trans;
	}

	public function getCFTimestamp() {
		return $this->cFTimestamp;
	}

	public function setCFTimestamp($cFTimestamp) {
		$this->cFTimestamp = $cFTimestamp;
		$this->queryParameters["CFTimestamp"]=$cFTimestamp;
	}

	public function getAppToken() {
		return $this->appToken;
	}

	public function setAppToken($appToken) {
		$this->appToken = $appToken;
		$this->queryParameters["AppToken"]=$appToken;
	}
	
}