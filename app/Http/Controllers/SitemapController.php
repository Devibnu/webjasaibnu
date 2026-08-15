<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = collect([
            ['loc' => rtrim(route('home'), '/'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('website-development'), 'changefreq' => 'weekly', 'priority' => '0.95'],
            ['loc' => route('website-development-serang'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route('website-development-banten'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route('services.index'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('solutions.index'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('portfolio.index'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('insights.index'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('about'), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => route('contact'), 'changefreq' => 'monthly', 'priority' => '0.5'],
        ]);

        $insightUrls = Insight::published()
            ->ordered()
            ->get()
            ->map(fn (Insight $insight) => [
                'loc' => route('insights.show', $insight->slug),
                'lastmod' => ($insight->updated_at ?: $insight->published_at)?->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ]);

        $urls = $urls
            ->merge($insightUrls)
            ->unique('loc')
            ->values();

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $content .= "  <url>\n";
            $content .= "    <loc>" . $this->escapeXml($url['loc']) . "</loc>\n";
            if (! empty($url['lastmod'])) {
                $content .= "    <lastmod>" . $this->escapeXml($url['lastmod']) . "</lastmod>\n";
            }
            $content .= "    <changefreq>" . $this->escapeXml($url['changefreq']) . "</changefreq>\n";
            $content .= "    <priority>" . $this->escapeXml($url['priority']) . "</priority>\n";
            $content .= "  </url>\n";
        }

        $content .= '</urlset>';

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    private function escapeXml(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_COMPAT, 'UTF-8');
    }
}
