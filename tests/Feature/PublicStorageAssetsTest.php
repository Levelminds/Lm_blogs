<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\UnableToRetrieveMetadata;
use Tests\TestCase;

class PublicStorageAssetsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $storageLink = public_path('storage');

        if (is_link($storageLink)) {
            unlink($storageLink);
        } elseif (is_dir($storageLink)) {
            File::deleteDirectory($storageLink);
        }
    }

    public function test_blog_thumbnail_urls_use_fallback_route_when_storage_link_missing(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('thumbnails/example.jpg', 'test content');

        $blog = Blog::create([
            'title' => 'Example post',
            'slug' => 'example-post',
            'excerpt' => 'Excerpt',
            'content' => '<p>Body</p>',
            'thumbnail' => 'thumbnails/example.jpg',
            'published_at' => now(),
            'metadata' => ['word_count' => 2],
            'media_type' => 'article',
        ]);

        $expected = route('storage.asset', ['path' => 'thumbnails/example.jpg'], false);

        $this->assertSame($expected, $blog->thumbnail_url);
    }

    public function test_public_storage_route_streams_files_when_symlink_is_missing(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('thumbnails/stream.jpg', 'streamed content');

        $response = $this->get('/storage/thumbnails/stream.jpg');

        $response->assertOk();

        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertNotNull($cacheControl);
        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('max-age=31536000', $cacheControl);

        $this->assertSame('streamed content', $response->streamedContent());
    }

    public function test_public_storage_route_streams_files_when_directory_exists_without_file(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('thumbnails/directory-blocked.jpg', 'directory fallback');

        File::ensureDirectoryExists(public_path('storage/thumbnails'));

        $blog = Blog::create([
            'title' => 'Directory blocked post',
            'slug' => 'directory-blocked-post',
            'excerpt' => 'Excerpt',
            'content' => '<p>Body</p>',
            'thumbnail' => 'thumbnails/directory-blocked.jpg',
            'published_at' => now(),
            'metadata' => ['word_count' => 2],
            'media_type' => 'article',
        ]);

        $expected = route('storage.asset', ['path' => 'thumbnails/directory-blocked.jpg'], false);

        $this->assertSame($expected, $blog->thumbnail_url);

        $response = $this->get('/storage/thumbnails/directory-blocked.jpg');

        $response->assertOk();

        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertNotNull($cacheControl);
        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('max-age=31536000', $cacheControl);

        $this->assertSame('directory fallback', $response->streamedContent());
    }

    public function test_missing_assets_return_not_found(): void
    {
        Storage::fake('public');

        $this->get('/storage/does-not-exist.png')->assertNotFound();
    }
}

