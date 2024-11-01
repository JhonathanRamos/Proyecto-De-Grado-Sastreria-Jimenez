<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail = 'laura65741113@gmail.com'; // Coloca aquí tu dirección de correo
    public string $fromName = 'Sastreria Jimenez'; // Nombre que deseas que aparezca en el remitente
    public string $recipients = '';

    /**
     * The "user agent"
     */
    public string $userAgent = 'CodeIgniter';

    /**
     * El protocolo de envío de correo: mail, sendmail, smtp
     */
    public string $protocol = 'smtp';

    /**
     * Ruta del servidor Sendmail.
     */
    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * Dirección del servidor SMTP
     */
    public string $SMTPHost = 'smtp.gmail.com';

    /**
     * Usuario SMTP
     */
    public string $SMTPUser = 'laura65741113@gmail.com';

    /**
     * Contraseña SMTP (usa contraseña de aplicación si tienes 2FA activado)
     */
    public string $SMTPPass = 'sqnq bfjq iqhy afpo
';

    /**
     * Puerto SMTP
     */
    public int $SMTPPort = 587;

    /**
     * Tiempo de espera de SMTP (en segundos)
     */
    public int $SMTPTimeout = 10;

    /**
     * Mantener conexión persistente de SMTP
     */
    public bool $SMTPKeepAlive = false;

    /**
     * Encriptación SMTP
     */
    public string $SMTPCrypto = 'tls';

    /**
     * Habilitar ajuste de línea
     */
    public bool $wordWrap = true;

    /**
     * Número de caracteres antes de ajustar línea
     */
    public int $wrapChars = 76;

    /**
     * Tipo de correo: 'text' o 'html'
     */
    public string $mailType = 'html';

    /**
     * Conjunto de caracteres (utf-8, iso-8859-1, etc.)
     */
    public string $charset = 'UTF-8';

    /**
     * Validar la dirección de correo
     */
    public bool $validate = true;

    /**
     * Prioridad del correo. 1 = más alta. 5 = más baja. 3 = normal
     */
    public int $priority = 3;

    /**
     * Caracter de salto de línea
     */
    public string $CRLF = "\r\n";

    /**
     * Caracter de salto de línea
     */
    public string $newline = "\r\n";

    /**
     * Habilitar el modo BCC Batch
     */
    public bool $BCCBatchMode = false;

    /**
     * Número de correos en cada lote BCC
     */
    public int $BCCBatchSize = 200;

    /**
     * Habilitar mensaje de notificación desde el servidor
     */
    public bool $DSN = false;
}