<?php
interface MiddlewareInterface {
    public function handle($request, $next);
}
?>
