<?php
/**
 * UniqueId, creates unique names.
 *
 *   UniqueId::id('foo') # => 'foo'
 *   UniqueId::id('foo') # => 'foo-2'
 *   UniqueId::id('foo') # => 'foo-3'
 *   UniqueId::id('foo', 'names') # => 'foo'
**/

class UniqueId {
  static $unique_ids = array();

  static function id($id, &$scope = 'default') {
    $new_id = $id;
    $i = 1;
    if (!isset(self::$unique_ids[$scope]))
      self::$unique_ids[$scope] = array();
    while (isset(self::$unique_ids[$scope][$new_id]))
      $new_id = $id . '-' . ++$i;
    self::$unique_ids[$scope][$new_id] = true;
    return $new_id;
  }

  static function reset() {
    self::$unique_ids = array();
  }
}

