
   BadMethodCallException  : Method Illuminate\Routing\Route::get does not exist.

  at C:\Users\Public\OSPanel\domains\Polygon.net\vendor\laravel\framework\src\Illuminate\Support\Traits\Macroable.php:77
    73|      */
    74|     public static function __callStatic($method, $parameters)
    75|     {
    76|         if (! static::hasMacro($method)) {
  > 77|             throw new BadMethodCallException(sprintf(
    78|                 'Method %s::%s does not exist.', static::class, $method
    79|             ));
    80|         }
    81|

  Exception trace:

  1   Illuminate\Routing\Route::__callStatic("get")
      C:\Users\Public\OSPanel\domains\Polygon.net\routes\web.php:19

  2   require("C:\Users\Public\OSPanel\domains\Polygon.net\routes\web.php")
      C:\Users\Public\OSPanel\domains\Polygon.net\vendor\laravel\framework\src\Illuminate\Routing\RouteFileRegistrar.php:35

  Please use the argument -v to see more details.
