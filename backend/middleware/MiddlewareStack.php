<?php

class MiddlewareStack {
    private $middlewares = [];

    public function addMiddleware(MiddlewareInterface $middleware) {
        $this->middlewares[] = $middleware;
    }

    public function handle($request, $finalHandler) {
        
        // Reverse the order of middlewares
        $middleware = array_reverse($this->middlewares);

        $next = function($request) use ($finalHandler) {
            return $finalHandler($request);
        };

        foreach ($middleware as $m) {
            $next = function($request) use ($m, $next) {
                return $m->handle($request, $next);
            };
        }

        return $next($request);
    }
}
?>
