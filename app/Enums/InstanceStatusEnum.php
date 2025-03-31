<?php

namespace App\Enums;

enum InstanceStatusEnum: int
{
    case QRCODE = 1;
    case CONNECTING = 2;
    case CONNECTED = 3;
    case DISCONNECTING = 4;
    case DISCONNECTED = 5;
    case PAIRING = 6;
    case TIMEOUT = 7;
    case PROTOCOL_ERROR = 8;
    case AUTH_FAILURE = 9;
    case UNKNOWN = 0;

    public static function getCode(string $status): ?self
    {
        return match (strtolower($status)) {
            'qrcode' => self::QRCODE,
            'connecting' => self::CONNECTING,
            'connected' => self::CONNECTED,
            'disconnecting' => self::DISCONNECTING,
            'disconnected' => self::DISCONNECTED,
            'pairing' => self::PAIRING,
            'timeout' => self::TIMEOUT,
            'protocol_error' => self::PROTOCOL_ERROR,
            'auth_failure' => self::AUTH_FAILURE,
            default => self::UNKNOWN
        };
    }
}