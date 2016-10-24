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

class CfAccountFeedbackRequest extends \RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("CF", "2015-11-27", "CfAccountFeedback");
		$this->setProtocol("https");
	}

	private  $appKey;

	private  $eventId;

	private  $userFeedback;

	private  $customerDecision;

	private  $aliDecision;

	private  $denyReason;

	private  $cFTimestamp;

	private  $appToken;

	public function getAppKey() {
		return $this->appKey;
	}

	public function setAppKey($appKey) {
		$this->appKey = $appKey;
		$this->queryParameters["AppKey"]=$appKey;
	}

	public function getEventId() {
		return $this->eventId;
	}

	public function setEventId($eventId) {
		$this->eventId = $eventId;
		$this->queryParameters["EventId"]=$eventId;
	}

	public function getUserFeedback() {
		return $this->userFeedback;
	}

	public function setUserFeedback($userFeedback) {
		$this->userFeedback = $userFeedback;
		$this->queryParameters["UserFeedback"]=$userFeedback;
	}

	public function getCustomerDecision() {
		return $this->customerDecision;
	}

	public function setCustomerDecision($customerDecision) {
		$this->customerDecision = $customerDecision;
		$this->queryParameters["CustomerDecision"]=$customerDecision;
	}

	public function getAliDecision() {
		return $this->aliDecision;
	}

	public function setAliDecision($aliDecision) {
		$this->aliDecision = $aliDecision;
		$this->queryParameters["AliDecision"]=$aliDecision;
	}

	public function getDenyReason() {
		return $this->denyReason;
	}

	public function setDenyReason($denyReason) {
		$this->denyReason = $denyReason;
		$this->queryParameters["DenyReason"]=$denyReason;
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