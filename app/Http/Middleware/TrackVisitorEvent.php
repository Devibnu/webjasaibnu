<?php

namespace App\Http\Middleware;

use App\Models\VisitorEvent;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitorEvent
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            try {
                VisitorEvent::create([
                    'path' => '/' . ltrim($request->path(), '/'),
                    'route_name' => $request->route()?->getName(),
                    'ip_hash' => hash('sha256', (string) $request->ip() . '|' . config('app.key')),
                    'user_agent_hash' => $request->userAgent()
                        ? hash('sha256', $request->userAgent() . '|' . config('app.key'))
                        : null,
                    'referer' => str($request->headers->get('referer'))->limit(500, '')->toString() ?: null,
                    'visited_on' => now()->toDateString(),
                    'visited_at' => now(),
                ]);
            } catch (\Throwable) {
                // Visitor tracking must never break the public website.
            }
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET') || ! $response->isSuccessful()) {
            return false;
        }

        if (! Schema::hasTable('visitor_events')) {
            return false;
        }

        if ($request->user()?->is_admin) {
            return false;
        }

        if ($request->expectsJson() || str_starts_with((string) $request->headers->get('accept'), 'application/json')) {
            return false;
        }

        if ($request->is([
            'admin',
            'admin/*',
            'weblogin',
            'logout',
            'build/*',
            'assets/*',
            'storage/*',
            'favicon.ico',
            'robots.txt',
            'sitemap.xml',
        ])) {
            return false;
        }

        return true;
    }
}
