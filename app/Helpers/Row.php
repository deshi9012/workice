<?php
namespace App\Helpers;

use Illuminate\Support\Collection;

class Row
{
    /**
     * summary.
     *
     * @var string
     */
    protected $collection;
    /**
     * Instantiate the anonymous class with .
     *
     * @author
     */
    public function __construct($data)
    {
        $this->collection = Collection::make($data);
    }
    /**
     * Get values fro the row collection.
     *
     * @param mixed object|null
     */
    public function __get($property)
    {
        $name = snake_case($property);
        if ($this->collection->has($name)) {
            return $this->collection->get($name);
        }
        return null;
    }
    /**
     * Emulate collection methods. just for convenience.
     *
     * @return array
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->collection, $method], $args);
    }
}
