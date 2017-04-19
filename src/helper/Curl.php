<?php namespace Hubstaff\Helper;

class Curl
{
    public function send($fields, $parameters, $url, $type = 0)
    {
        $post_string = '';
        $header_string = '';
        $post_string = $this->extractHeader($fields, $parameters, $header_string, $post_string);
        $post_string = rtrim($post_string, '&');
        list($curl, $result) = $this->sendRequest($fields, $url, $type, $post_string, $header_string);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpCode != 200 && $httpCode != 201) {
            if ($httpCode == '400' || $httpCode == '401' || $httpCode == '403' || $httpCode == '404' || $httpCode == '406' || $httpCode == '409' || $httpCode == '429' || $httpCode == '500' || $httpCode == '502' || $httpCode == '403') {
                $error = ['error' => curl_error($curl)];
            } else {
                $error = ['error' => 'Unexpected Error from hubstaff-php'];
            }
            return json_encode($error);
        }

        curl_close($curl);
        return $result;
    }

    /**
     * @param $fields
     * @param $url
     * @param $type
     * @param $post_string
     * @param $header_string
     * @return array
     */
    protected function sendRequest($fields, $url, $type, $post_string, $header_string)
    {
        $curl = curl_init();
        if (! $type) {
            curl_setopt($curl, CURLOPT_URL, $url . '?' . $post_string);
        } else
            curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header_string);
        if ($type) {
            curl_setopt($curl, CURLOPT_POST, count($fields));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_string);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        return array($curl, $result);
    }

    /**
     * @param $fields
     * @param $parameters
     *
     * @return string
     */
    public function extractHeader($fields, $parameters)
    {
        $headers = array_filter(
            $fields,
            function ($key) use ($parameters) {
                return isset($parameters[$key]) && $parameters[$key] === 'header';
            },
            ARRAY_FILTER_USE_KEY
        );

        // @todo to refactor later
        $header_string = '';
        foreach ($headers as $key => $v) {
            $header_string .= $key . ': ' . $v;
        }
        return $header_string;
    }
}
