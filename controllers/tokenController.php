<?php
// token生成
include($_SERVER['DOCUMENT_ROOT'] . "/src/RtcTokenBuilder.php");
include($_SERVER['DOCUMENT_ROOT'] . "/src/RtmTokenBuilder.php");

class tokenController
{

    private $appID = "";
    private $appCertificate = "";

    public function RtcTokenBuilderSample()
    {
    }

    public function RtmTokenBuilderSample()
    {
    }
}