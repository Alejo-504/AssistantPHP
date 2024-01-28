<?php

namespace assistant_php;

class ObjectAssistant extends ObjectBase
{
   /**
    * Crea un asistente.
    *
    * @param string $model El modelo del asistente.
    * @param string $name El nombre del asistente.
    * @param string $description La descripción del asistente.
    * @param string $instructions Las instrucciones para el asistente.
    * @param array $tools Las herramientas que el asistente utilizará.
    * @param array $files_id Los IDs de los archivos que el asistente utilizará.
    * @param array $metadatos Los metadatos del asistente.
    * @return object assitant object
    */
   public function create_assistant($model, $name, $description, $instructions, $tools, $files_id, $metadatos)
   {
      $url = "https://api.openai.com/v1/assistants";
      $data = array(
         "instructions" => $instructions,
         "name" => $name,
         "description" => $description,
         "tools" => $tools,
         "model" => $model,
         "file_ids" => $files_id,
         "metadata" => $metadatos

      );
     
      return $this->post($url, $data);
   }
   /**
    * Crea un archivo de un asistente.
    *
    * @param string $assistant_id El ID del asistente. 
    * @param string $file_id El ID del archivo.
    * @return object object file {
         "id": "file-abc123",
         "object": "assistant.file",
         "created_at": 1699055364,
         "assistant_id": "asst_abc123"
      } 
    */
   public function create_assistant_file($assistant_id, $file_id)
   {
      $url = "https://api.openai.com/v1/assistants/" . $assistant_id . "/files";
      $data = array(
         "file_id" => $file_id
      );

      return $this->post($url, $data);
   }
   /**
    * Obtiene una lista de asistentes.
    *
    * @param string $limit El número máximo de asistentes para devolver. El valor predeterminado es 20.
    * @param string $order El orden de los asistentes devueltos. El valor predeterminado es desc.
    * @param string $after El ID del asistente después del cual se devolverán los asistentes.
    * @param string $before El ID del asistente antes del cual se devolverán los asistentes.
    * @return array La respuesta una lista de assitentes. 
    */

   public function get_assitants($limit = 20, $order = "desc", $after = null, $before = null)
   {
      $params = array(
         "order" => $order,
         "limit" => $limit,
         "after" => $after,
         "before" => $before
      );
      $url = "https://api.openai.com/v1/assistants";
      return $this->get($url, $params);
   }
   /**
    * Obtiene una lista de archivos de un asistente.
    *
    * @param string $assistant_id El ID del asistente.
    * @param string $limit El número máximo de asistentes para devolver. El valor predeterminado es 20.
    * @param string $order El orden de los asistentes devueltos. El valor predeterminado es desc.
    * @param string $after El ID del asistente después del cual se devolverán los asistentes.
    * @param string $before El ID del asistente antes del cual se devolverán los asistentes.
    * @return array una lista de archivos de un asistente. */

   public function get_assistant_files($assistant_id, $limit = 20, $order = "desc", $after = null, $before = null)
   {

      $params = array(
         "order" => $order,
         "limit" => $limit,
         "after" => $after,
         "before" => $before
      );
      $url = "https://api.openai.com/v1/assistants/" . $assistant_id . "/files";
      return $this->get($url, $params);
   }
   /**
    * Obtiene un archivo de un asistente.
    *
    * @param string $assistant_id El ID del asistente. 
    * @param string $file_id El ID del archivo. 
    * @return object assistant_file
 */

   public function get_assistant_file($assistant_id, $file_id)
   {
      $url = "https://api.openai.com/v1/assistants/" . $assistant_id . "/files/" . $file_id;
      return $this->get($url);
   }
   /**
    * Modifica un asistente.
    *
    * @param string $assistant_id El ID del asistente. 
    * @param string $model El modelo del asistente.
    * @param string $name El nombre del asistente.
    * @param string $description La descripción del asistente.
    * @param string $instructions Las instrucciones para el asistente.
    * @param array $tools Las herramientas que el asistente utilizará.
    * @param array $files_id Los IDs de los archivos que el asistente utilizará.
    * @param array $metadatos Los metadatos del asistente. hasta 16 campos clave-valor
    * @return object assitant object
    */
   public function modify_assistant($assistant_id, $model, $name, $description, $instructions, $tools, $files_id, $metadatos)
   {
      $url = "https://api.openai.com/v1/assistants/" . $assistant_id;
      $data = array(
         "instructions" => $instructions,
         "name" => $name,
         "description" => $description,
         "tools" => $tools,
         "model" => $model,
         "file_ids" => $files_id,
         "metadata" => $metadatos

      );
      
      return $this->patch($url, $data);
   }
   /**
    * Elimina un asistente.
    * @param string $assistant_id El ID del asistente.
    * @return array Deletion status
    */
   public function delete_assistant($assistant_id)
   {
      $url = "https://api.openai.com/v1/assistants/" . $assistant_id;
      return $this->delete($url);
   }

   /**
    * Elimina un archivo de un asistente.
    * @param string $assistant_id El ID del asistente.
    * @param string $file_id El ID del archivo.
    * @return array Deletion status
    */
   public function delete_assistant_file($assistant_id, $file_id)
   {
      $url = "https://api.openai.com/v1/assistants/" . $assistant_id . "/files/" . $file_id;
      return $this->delete($url);
   }
}
