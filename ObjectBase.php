<?php
namespace assistant_php;

class ObjectBase
{
   protected static $apiKey;

 
   public function setApiKey($apiKey)
   {
      self::$apiKey = $apiKey;
   }

   public function post($url, $data=array())
   {
      $data_string = json_encode($data);

      $ch = curl_init($url);

      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      if(count($data) > 0){
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      }
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Authorization: Bearer ' . self::$apiKey,
          'OpenAI-Beta: assistants=v1'
      ));
      $result = curl_exec($ch);
      curl_close($ch);

      return $result;
   }

   public function get($url, $params = array())
   {
      $params = array_filter($params, function ($value) {
         return $value !== null;
      });
      if(count($params) > 0){
         $url .= '?';
         foreach($params as $key => $value){
           $url .= $key . '=' . $value . '&';
         }
         $url = substr($url, 0, -1);
      }
      $ch = curl_init($url);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Authorization: Bearer ' . self::$apiKey,
          'OpenAI-Beta: assistants=v1'
      ));
      $result = curl_exec($ch);
      curl_close($ch);

      return $result;
   }
   public function patch($url, $data)
   {
      $data_string = json_encode($data);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Authorization: Bearer ' . self::$apiKey,
          'OpenAI-Beta: assistants=v1'
      ));
      $result = curl_exec($ch);
      curl_close($ch);

      return $result;
   }
   public function put($url, $data)
   {
      $data_string = json_encode($data);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Authorization: Bearer ' . self::$apiKey,
          'OpenAI-Beta: assistants=v1'
      ));
      $result = curl_exec($ch);
      curl_close($ch);

      return $result;
   }
   public function delete($url)
   {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Authorization: Bearer ' . self::$apiKey,
          'OpenAI-Beta: assistants=v1'
      ));
      $result = curl_exec($ch);
      curl_close($ch);

      return $result;
   }

}