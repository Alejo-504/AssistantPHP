<?php

namespace assistant_php;

class ObjectThread extends ObjectBase
{
   /** 
    * Crea un hilo de conversación.
    * @param array $messages
    * @param object $metadata
    *  */
   public function create_thread($messages, $metadata)
   {
      $url = "https://api.openai.com/v1/threads";
      $data = array(
         "messages" => $messages,
         "metadata" => $metadata
      );
      return $this->post($url, $data);
   }
   /** 
   Recupera un hilo de conversación.
    * @param string $thread_id El ID del hilo de conversación.
    * @return object The thread object matching the specified ID.
    **/
   public function get_thread($thread_id)
   {
      $url = "https://api.openai.com/v1/threads/" . $thread_id;
      return $this->get($url);
   }
   /**
    * Modifica un hilo de conversación.
    * @param string $thread_id El ID del hilo de conversación. The ID of the thread to modify. Only the metadata can be modified.
    * @param array $metadata
    * @return object The modified thread object matching the specified ID.
    */
   public function modify_thread($thread_id, $metadata)
   {
      $url = "https://api.openai.com/v1/threads/" . $thread_id;
      $data = array(
         "metadata" => $metadata
      );
      return $this->patch($url, $data);
   }
   /**
    * Elimina un hilo de conversación.
    * @param string $thread_id El ID del hilo de conversación. The ID of the thread to delete.
    * @return array Deletion status
    */
   public function delete_thread($thread_id)
   {
      $url = "https://api.openai.com/v1/threads/" . $thread_id;
      return $this->delete($url);
   }
}
