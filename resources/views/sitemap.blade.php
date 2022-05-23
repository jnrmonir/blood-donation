<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{url('home')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('request-for-blood')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('requested-bloods')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('blood-donars')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('blogs')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('about-us')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('contact-us')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('support-us')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('terms-&-conditions')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('privacy-&-policy')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    <url>
        <loc>{{url('user/profile')}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime('2021-02-20')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>

    @foreach ($posts as $post)
        <url>
            <loc>{{url('blog/'.$post->slug)}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($post->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    @foreach ($bloodDonars as $bloodDonar)
        <url>
            <loc>{{url('blood-donar/'.$bloodDonar->slug)}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($bloodDonar->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach


    @foreach ($requestedBloods as $requestedBlood)
        <url>
            <loc>{{url('requested-blood/'.$requestedBlood->slug)}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($requestedBlood->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach


</urlset>
