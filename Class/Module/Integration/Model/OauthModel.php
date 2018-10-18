<?php

namespace App\Module\Integration\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class OauthModel extends Model
{
    private $id;
    private $uuid;
    private $integrationId;
    private $token;
    private $refreshToken;

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(string $refreshToken): OauthModel
    {
        $this->set('refresh_token', $refreshToken);
        $this->refreshToken = $refreshToken;
        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): OauthModel
    {
        $this->set('token', $token);
        $this->token = $token;
        return $this;
    }

    public function getIntegrationId(): int
    {
        return $this->integrationId;
    }

    public function setIntegrationId(int $integrationId): OauthModel
    {
        $this->set('integration_id', $integrationId);
        $this->integrationId = $integrationId;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): OauthModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): OauthModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}