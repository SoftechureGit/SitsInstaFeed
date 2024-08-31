<?php
namespace Sits\SitsInstaFeed\Http\Middleware;

use Closure;

class InjectCssCdnMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->isSuccessful() && $response->headers->get('Content-Type') === 'text/html; charset=UTF-8') {
            $content = $response->getContent();
            $cssCdnLink = '<link rel="stylesheet" href="https://www.website4test.com/social_feed/package-cdn/css-cdn/sits-widget.css">';
            $jsCdnLink = '<script src="https://www.website4test.com/social_feed/package-cdn/js-cdn/sits-widget.js"></script>';
            $content = str_replace('</head>', $cssCdnLink . '</head>', $content);
            $content = str_replace('</body>', $jsCdnLink . '</body>', $content);

            $response->setContent($content);
        }

        return $response;
    }
}
