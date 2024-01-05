<?php
namespace assistant_php;

class ObjectMessage extends ObjectBase
{
    /**  
     * Crea un mensaje en un hilo de conversación.
     * @param string $thread_id El ID del hilo de conversación. The ID of the thread to create a message for.
     * @param string $role El rol de la entidad que crea el mensaje. Actualmente solo se admite el usuario.
     * @param string $content El contenido del mensaje.
     * @param array $file_ids Una lista de IDs de archivos que el mensaje debe utilizar. Puede haber un máximo de 10 archivos adjuntos a un mensaje. Útil para herramientas como retrieval y code_interpreter que pueden acceder y utilizar archivos.
     * @param object $metadata Conjunto de 16 pares clave-valor que se pueden adjuntar a un objeto. Esto puede ser útil para almacenar información adicional sobre el objeto en un formato estructurado. Las claves pueden tener un máximo de 64 caracteres de longitud y los valores pueden tener un máximo de 512 caracteres de longitud.
     * @return object A message object.
    */

    public function create_message($thread_id, $role, $content, $file_ids, $metadata)
    {
        $url = "https://api.openai.com/v1/threads/" . $thread_id . "/messages";
        $data = array(
            "role" => $role,
            "content" => $content,
            "file_ids" => $file_ids,
            "metadata" => $metadata
        );
   
        return $this->post($url, $data);
    }
    /**
     * Obtiene una lista de mensajes para un hilo dado.
     * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
     * @param string $limit Un límite en el número de objetos que se devolverán. El límite puede variar entre 1 y 100, y el valor predeterminado es 20.
     * @param string $order El orden de clasificación por la marca de tiempo created_at de los objetos. asc para orden ascendente y desc para orden descendente.
     * @param string $after Un cursor para su uso en la paginación. after es un ID de objeto que define su posición en la lista. Por ejemplo, si realiza una solicitud de lista y recibe 100 objetos, terminando con obj_foo, su llamada posterior puede incluir after=obj_foo para recuperar la siguiente página de la lista.
     * @param string $before Un cursor para su uso en la paginación. before es un ID de objeto que define su posición en la lista. Por ejemplo, si realiza una solicitud de lista y recibe 100 objetos, terminando con obj_foo, su llamada posterior puede incluir before=obj_foo para recuperar la página anterior de la lista.
     * @return array A list of message objects.
     */
    public function get_messages($thread_id, $limit = 20, $order = "desc", $after = null, $before = null)
    {
        $params = array(
            "order" => $order,
            "limit" => $limit,
            "after" => $after,
            "before" => $before
        );
        $url = "https://api.openai.com/v1/threads/" . $thread_id . "/messages";
        return $this->get($url, $params);
    }

    /** 
     * Obtiene una lista de archivos de un mensaje.
     * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
     * @param string $message_id El ID del mensaje al que pertenecen los archivos.
     * //query parameters
     * @param string $limit Un límite en el número de objetos que se devolverán. El límite puede variar entre 1 y 100, y el valor predeterminado es 20.
     * @param string $order El orden de clasificación por la marca de tiempo created_at de los objetos. asc para orden ascendente y desc para orden descendente.
     * @param string $after Un cursor para su uso en la paginación. after es un ID de objeto que define su posición en la lista. Por ejemplo, si realiza una solicitud de lista y recibe 100 objetos, terminando con obj_foo, su llamada posterior puede incluir after=obj_foo para recuperar la siguiente página de la lista.
     * @param string $before Un cursor para su uso en la paginación. before es un ID de objeto que define su posición en la lista. Por ejemplo, si realiza una solicitud de lista y recibe 100 objetos, terminando con obj_foo, su llamada posterior puede incluir before=obj_foo para recuperar la página anterior de la lista.
     * @return array A list of message file objects.*
     * @example curl https://api.openai.com/v1/threads/thread_abc123/messages/msg_abc123/files \
  -H "Authorization: Bearer $OPENAI_API_KEY" \
  -H "Content-Type: application/json" \
  -H "OpenAI-Beta: assistants=v1"
     */
    public function get_message_files($thread_id, $message_id, $limit = 20, $order = "desc", $after = null, $before = null)
    {

      $params = array(
        "order" => $order,
        "limit" => $limit,
        "after" => $after,
        "before" => $before
      );
      $url = "https://api.openai.com/v1/threads/" . $thread_id . "/messages/" . $message_id . "/files";
      return $this->get($url, $params);
      
    }
    /** 
     * Get a message
     * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
     * @param string $message_id El ID del mensaje al que pertenecen los archivos.
     * @return object A message object.
     */

    public function get_message($thread_id, $message_id)
    {
        $url = "https://api.openai.com/v1/threads/" . $thread_id . "/messages/" . $message_id;
        return $this->get($url);
    }

    /**
     * get message file
     * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
     * @param string $message_id El ID del mensaje al que pertenecen los archivos.
     * @param string $file_id El ID del archivo.
     * @return object A message file object.
     */
    public function get_message_file($thread_id, $message_id, $file_id)
    {
        $url = "https://api.openai.com/v1/threads/" . $thread_id . "/messages/" . $message_id . "/files/" . $file_id;
        return $this->get($url);
    }

    /**
     * Modify message
     * @param string $thread_id The ID of the thread to which this message belongs.
     * @param string $message_id The ID of the message to modify.
     * @param object $metadata Set of 16 key-value pairs that can be attached to an object. This can be useful for storing additional information about the object in a structured format. Keys can be a maximum of 64 characters long and values can be a maxium of 512 characters long.
     * @return object The modified message object.
     */
    public function modify_message($thread_id, $message_id, $metadata)
    {
        $url = "https://api.openai.com/v1/threads/" . $thread_id . "/messages/" . $message_id;
        $data = array(
            "metadata" => $metadata
        );
      
        return $this->patch($url, $data);
    }
}
