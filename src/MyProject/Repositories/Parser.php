<?php

namespace MyProject\Repositories;
use MyProject\Models\parsers\ParserAdd;
use MyProject\Services\Db;
use MyProject\View\View;

class Parser
{
    /** @var View */
    private $view;


    private static $error_codes = [
        "CURLE_UNSUPPORTED_PROTOCOL",
        "CURLE_FAILED_INIT",

        // Тут более 60 элементов, в архиве вы найдете весь список

        "CURLE_FTP_BAD_FILE_LIST",
        "CURLE_CHUNK_FAILED"
    ];
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }
    public static function getPage($params = []){

        if($params){

            if(!empty($params["url"])){

                $url = $params["url"];

                $useragent      = !empty($params["useragent"]) ? $params["useragent"] : "Mozilla/5.0 (Windows NT 6.3; W…) Gecko/20100101 Firefox/57.0";
                $timeout        = !empty($params["timeout"]) ? $params["timeout"] : 5;
                $connecttimeout = !empty($params["connecttimeout"]) ? $params["connecttimeout"] : 5;
                $head           = !empty($params["head"]) ? $params["head"] : false;

                $cookie_file    = !empty($params["cookie"]["file"]) ? $params["cookie"]["file"] : false;
                $cookie_session = !empty($params["cookie"]["session"]) ? $params["cookie"]["session"] : false;

                $proxy_ip   = !empty($params["proxy"]["ip"]) ? $params["proxy"]["ip"] : false;
                $proxy_port = !empty($params["proxy"]["port"]) ? $params["proxy"]["port"] : false;
                $proxy_type = !empty($params["proxy"]["type"]) ? $params["proxy"]["type"] : false;

                $headers = !empty($params["headers"]) ? $params["headers"] : false;

                $post = !empty($params["post"]) ? $params["post"] : false;

                if($cookie_file){

                    file_put_contents(__DIR__ . "Parser.php/" .$cookie_file, "");
                }
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connecttimeout);
                if($head){

                    curl_setopt($ch, CURLOPT_HEADER, true);
                    curl_setopt($ch, CURLOPT_NOBODY, true);
                }
                if(strpos($url, "https") !== false){

                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                }
                if($cookie_file){

                    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . "Parser.php/" .$cookie_file);
                    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . "Parser.php/" .$cookie_file);

                    if($cookie_session){

                        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
                    }
                }
                if($proxy_ip && $proxy_port && $proxy_type){

                    curl_setopt($ch, CURLOPT_PROXY, $proxy_ip.":".$proxy_port);
                    curl_setopt($ch, CURLOPT_PROXYTYPE, $proxy_type);
                }

                if($headers){

                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                }

                if($post){

                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                }

                curl_setopt($ch, CURLINFO_HEADER_OUT, true);

                $content = curl_exec($ch);
                $info      = curl_getinfo($ch);

                $error = false;

                if($content === false){

                    $data = false;

                    $error["message"] = curl_error($ch);
                    $error["code"]      = self::$error_codes[
                    curl_errno($ch)
                    ];
                }else{

                    $data["content"] = $content;
                    $data["info"]      = $info;
                }

                curl_close($ch);

                return [
                    "data"    => $data,
                    "error" => $error
                ];

            }
            var_dump($data);

        }

        return false;
    }
}