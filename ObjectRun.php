<?php

namespace assistant_php;

class ObjectRun extends ObjectBase
{
  /**
   * Crea un run
   * @param string $thread_id El ID del hilo de conversación.
   * @param string $assistant_id El ID del asistente.
   * @param string $model El modelo del asistente.
   * @param string $instructions Las instrucciones para el asistente.
   * @param string $additional_instructions Las instrucciones adicionales para el asistente.
   * @param array $tools Las herramientas que el asistente utilizará.
   * @param array $metadata Los metadatos del asistente.
   * @return object a run object.
   */
  public function create_run($thread_id, $assistant_id, $model, $instructions, $additional_instructions, $tools, $metadata)
  {
    $url = "https://api.openai.com/v1/threads/" . $thread_id . "/runs";
    $data = array(
      "assistant_id" => $assistant_id,
      "model" => $model,
      "instructions" => $instructions,
      "additional_instructions" => $additional_instructions,
      "tools" => $tools,
      "metadata" => $metadata
    );

    return $this->post($url, $data);
  }
  /**
   * Crea un hilo de conversación y un run
   * @param string $assistant_id El ID del asistente.
   * @param string $model El modelo del asistente.
   * @param string $instructions Las instrucciones para el asistente.
   * @param string $additional_instructions Las instrucciones adicionales para el asistente.
   * @param array $tools Las herramientas que el asistente utilizará.
   * @param array $metadata Los metadatos del asistente.
   * @return object a run object.
   */
  public function create_thread_and_run($assistant_id, $model, $instructions, $additional_instructions, $tools, $metadata)
  {
    $url = "https://api.openai.com/v1/threads/runs";
    $data = array(
      "assistant_id" => $assistant_id,
      "model" => $model,
      "instructions" => $instructions,
      "additional_instructions" => $additional_instructions,
      "tools" => $tools,
      "metadata" => $metadata
    );

    return $this->post($url, $data);
  }
  /**
   * Obtiene una lista de runs.
   * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
   * @param string $limit Un límite en el número de objetos que se devolverán. El límite puede variar entre 1 y 100, y el valor predeterminado es 20.
   * @param string $order El orden de clasificación por la marca de tiempo created_at de los objetos. asc para orden ascendente y desc para orden descendente.
   * @param string $after Un cursor para su uso en la paginación. after es un ID de objeto que define su posición en la lista. Por ejemplo, si realiza una solicitud de lista y recibe 100 objetos, terminando con obj_foo, su llamada posterior puede incluir after=obj_foo para recuperar la siguiente página de la lista.
   * @param string $before Un cursor para su uso en la paginación. before es un ID de objeto que define su posición en la lista. Por ejemplo, si realiza una solicitud de lista y recibe 100 objetos, terminando con obj_foo, su llamada posterior puede incluir before=obj_foo para recuperar la página anterior de la lista.
   * @return array A list of run objects.*/
  public function list_runs($thread_id, $limit = 20, $order = "desc", $after = null, $before = null)
  {
    $params = array(
      "order" => $order,
      "limit" => $limit,
      "after" => $after,
      "before" => $before
    );
    $url = "https://api.openai.com/v1/threads/" . $thread_id . "/runs";
    return $this->get($url, $params);
  }
  /**
   * Get a List of Run Steps
   * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
   * @param string $run_id El ID del run al que pertenecen los mensajes.
   * @param string $limit Un límite en el número de objetos que se devolverán. El límite puede variar entre 1 y 100, y el valor predeterminado es 20.
   * @param string $order El orden de clasificación por la marca de tiempo created_at de los objetos. asc para orden ascendente y desc para orden descendente.
   * @param string $after Un cursor para su uso en la paginación. after es un ID de objeto que define su posición en la lista. Por ejemplo, si realiza una solicitud de lista y recibe 100 objetos, terminando con obj_foo, su llamada posterior puede incluir after=obj_foo para recuperar la siguiente página de la lista.
   * @param string $before Un cursor para su uso en la paginación. before es un ID de objeto que define su posición en la lista. Por ejemplo, si realiza una solicitud de lista y recibe 100 objetos, terminando con obj_foo, su llamada posterior puede incluir before=obj_foo para recuperar la página anterior de la lista.
   * @return array A list of run objects. */

  public function list_run_steps($thread_id, $run_id, $limit = 20, $order = "desc", $after = null, $before = null)
  {
    $params = array(
      "order" => $order,
      "limit" => $limit,
      "after" => $after,
      "before" => $before
    );
    $url = "https://api.openai.com/v1/threads/" . $thread_id . "/runs/" . $run_id . "/steps";
    return $this->get($url, $params);
  }
  /**
   * Get a run
   * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
   * @param string $run_id El ID del run al que pertenecen los mensajes.
   * @return object The run object matching the specified ID. */

  public function get_run($thread_id, $run_id)
  {
    $url = "https://api.openai.com/v1/threads/" . $thread_id . "/runs/" . $run_id;
    return $this->get($url);
  }
  /**
   * Get run step
   * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
   * @param string $run_id El ID del run al que pertenecen los mensajes.
   * @param string $step_id El ID del run step.
   * @return object The run object matching the specified ID.
   */
  public function get_run_step($thread_id, $run_id, $step_id)
  {
    $url = "https://api.openai.com/v1/threads/" . $thread_id . "/runs/" . $run_id . "/steps/" . $step_id;
    return $this->get($url);
  }
  /**
   *  Modifies run
   * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
   * @param string $run_id El ID del run al que pertenecen los mensajes.
   * @param array $metadata
   * @return object The modified run object matching the specified ID.
   */
  public function modify_run($thread_id, $run_id, $metadata)
  {
    $url = "https://api.openai.com/v1/threads/" . $thread_id . "/runs/" . $run_id;
    $data = array(
      "metadata" => $metadata
    );
    return $this->patch($url, $data);
  }
  /**
   * Submit tool outputs to run
   * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
   * @param string $run_id El ID del run al que pertenecen los mensajes.
   * @param array $tool_outputs
   * @return object The modified run object matching the specified ID.
   */
  public function submit_tool_outputs($thread_id, $run_id, $tool_outputs)
  {
    $url = "https://api.openai.com/v1/threads/" . $thread_id . "/runs/" . $run_id . "/submit_tool_outputs";
    $data = array(
      "tool_outputs" => $tool_outputs
    );
    return $this->post($url, $data);
  }
  /**
   * Cancel a run
   * @param string $thread_id El ID del hilo al que pertenecen los mensajes.
   * @param string $run_id El ID del run al que pertenecen los mensajes.
   * @return object The modified run object matching the specified ID.*/
  public function cancel_run($thread_id, $run_id)
  {
    $url = "https://api.openai.com/v1/threads/" . $thread_id . "/runs/" . $run_id . "/cancel";
    return $this->post($url);
  }
}
