<?php
class JWT{
    //Fonction qui génère le token
    public function generateToken (array $header, array $payload, string $secret, int $validity = 86400): string {
        if ($validity > 0){
            $now = new DateTime();
            $expiration = $now->getTimestamp() + $validity;
            $payload['iat'] = $now->getTimestamp();
            $payload['exp'] = $expiration;
        }
        //Encodage du header et contenu du token en Base64
        $base64Header = base64_encode(json_encode($header));
        $base64Payload = base64_encode(json_encode($payload));

        //Nettoyage des valeurs encodées en rétirant et remplaçant
        //les caractères non supportés par jwt (+, / et =)
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], $base64Header);
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], $base64Payload);

        //Génération de la signature
        $secret = base64_encode($secret);
        $base64Secret = str_replace(['='], [''], $secret);

        $signature = hash_hmac('sha256', $base64Header . '.' . $base64Payload, $base64Secret, true);
        $base64Signature = base64_encode($signature);
        $signature = str_replace(['+', '/', '='], ['-', '_', ''], $base64Signature);

        //Création de token
        $jwt = $base64Header . '.' . $base64Payload . '.' . $signature;

        return $jwt;
    }

    //Démonter le token en récupérant tour à tour le Header et Payload
    public function getHeader($token){
        list($header, $payload, $secret) = explode(".", $token);
        $decodeHeader = json_decode(base64_decode($header), true);

        return $decodeHeader;
    }

    public function getPayload($token){
        list($header, $payload, $secret) = explode(".", $token);
        $decodePayload = json_decode(base64_decode($payload), true);

        return $decodePayload;
    }

    //Vérifie et match le token reçu et celui stocké dans la base
    public function checkToken(string $token, string $secret): bool{
        $header = $this->getHeader($token);
        $payload = $this->getPayload($token);

        $verifyToken = $this->generateToken($header, $payload, $secret, 0);
        
        return ($token === $verifyToken) ? true : false;
    }

    //Vérifie si le token n'est pas expiré
    public function isExpiredToken(string $token): bool{
        $payload = $this->getPayload($token);
        $now = New DateTime();
        return $payload['exp'] < $now->getTimestamp();
    }

    //Vérifie si le token est valide selon son format
    public function isValidToken(string $token): bool{
        return preg_match('/^[a-zA-Z0-9\-\_]+\.[a-zA-Z0-9\-\_]+\.[a-zA-Z0-9\-\_]+$/', $token) === 1;
    }
}