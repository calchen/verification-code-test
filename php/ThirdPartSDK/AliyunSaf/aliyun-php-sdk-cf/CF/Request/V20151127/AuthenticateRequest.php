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

class AuthenticateRequest extends \RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("CF", "2015-11-27", "Authenticate");
		$this->setProtocol("https");
	}

	private  $serno;

	private  $token;

	private  $sessionId;

	private  $remoteIp;

	private  $sig;

	private  $appKey;

	private  $sceneId;

	public function getSerno() {
		return $this->serno;
	}

	public function setSerno($serno) {
		$this->serno = $serno;
		$this->queryParameters["Serno"]=$serno;
	}

	public function getToken() {
		return $this->token;
	}

	public function setToken($token) {
		$this->token = $token;
		$this->queryParameters["Token"]=$token;
	}

	public function getSessionId() {
		return $this->sessionId;
	}

	public function setSessionId($sessionId) {
		$this->sessionId = $sessionId;
		$this->queryParameters["SessionId"]=$sessionId;
	}

	public function getRemoteIp() {
		return $this->remoteIp;
	}

	public function setRemoteIp($remoteIp) {
		$this->remoteIp = $remoteIp;
		$this->queryParameters["RemoteIp"]=$remoteIp;
	}

	public function getSig() {
		return $this->sig;
	}

	public function setSig($sig) {
		$this->sig = $sig;
		$this->queryParameters["Sig"]=$sig;
	}

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
	
}