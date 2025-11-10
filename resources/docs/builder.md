# Builder Templates Guide

This guide summarises the researched landing-page sections, documents the JSON structure the builder expects, and walks administrators through creating, importing, and publishing templates.

## Template research summary

| Template | Inspiration | Section structure | Required assets | Reference |
| --- | --- | --- | --- | --- |
| **Aurora Hero Launch** | Flowbite Marketing Hero | Hero headline, supporting copy, dual CTA buttons, stat pills, partner logo wall | 1600×900 gradient background, 5–6 monochrome SVG logos | [flowbite.com/blocks/marketing/hero](https://flowbite.com/blocks/marketing/hero/)
| **Spectrum Feature Grid** | HyperUI Marketing Features | Intro heading, supporting paragraph, 3×2 responsive feature cards, CTA strip | Set of six monochrome SVG icons sized 48×48 | [hyperui.dev/components/marketing/features](https://www.hyperui.dev/components/marketing/features)
| **Pulse Team Spotlight** | Tailwind Elements Team Cards | Section heading, responsive team grid (two rows), cards with avatar/name/role/socials | Square headshots (400×400) on neutral background | [tailwind-elements.com/components/team](https://tailwind-elements.com/docs/standard/components/team/)
| **Resonance Testimonials** | Flowbite Testimonials | Section heading, responsive testimonial cards with quote/author/rating | Circular avatars (160×160) with subtle shadow | [flowbite.com/blocks/marketing/testimonial](https://flowbite.com/blocks/marketing/testimonial/)

Each template above is encoded as a JSON fixture under `database/templates/` so it can be loaded directly into the builder.

## JSON template schema

Templates are described with the following structure:

```json
{
  "name": "Aurora Hero Launch",
  "slug": "aurora-hero-launch",
  "status": "draft",
  "layout_variant": "hero-centered",
  "description": "…",
  "theme": { "name": "Default" },
  "meta": {
    "source": "https://…",
    "structure": ["Hero headline", "Dual CTA", "Logo wall"],
    "assets": [{"key": "hero-background", "type": "image", "description": "1600×900 gradient"}]
  },
  "sections": [
    {
      "title": "Hero",
      "handle": "hero",
      "type": "hero",
      "position": 1,
      "settings": { "alignment": "center", "padding": "py-24" },
      "content": { "heading": "…", "subheading": "…", "primary_cta": {"label": "Start", "url": "/builder"} },
      "blocks": [
        {
          "type": "stat-pill",
          "title": "Social proof",
          "content": { "items": [{"label": "Teams", "value": "320+"}] }
        }
      ]
    }
  ]
}
```

* `theme` is optional; when omitted the importer attaches the first available theme. Providing `{"name": "Default"}` ensures the template inherits the brand palette.
* `meta.assets` captures imagery or icon requirements so administrators know what to upload after import. The importer stores this metadata on the template record.
* Each section and block honours the database schema (`page_sections` and `page_blocks` tables) so positions, handles, settings, and content are preserved.

## Creating a template via the builder UI

1. Sign in to the admin panel and open **Builder → Templates**.
2. Click **New template** and supply the name, slug, layout variant, and a short description.
3. Choose a theme (or accept the default). Saving will create an empty template in **Draft** state.
4. Use the section toolbar to add modules (Hero, Feature grid, Team, Testimonial, etc.). Drag to reorder and edit content in-line.
5. Attach CTAs, metrics, and other block-level settings as needed. Changes are auto-saved in draft until published.

## Importing templates from JSON

1. Drop JSON fixtures into `database/templates/`. The repository already includes:
   * `aurora-hero.json`
   * `spectrum-features.json`
   * `pulse-team.json`
   * `resonance-testimonials.json`
2. Run the artisan command to process every JSON file in the folder:
   ```bash
   php artisan builder:import-templates
   ```
   Supply a single file path to import a specific fixture:
   ```bash
   php artisan builder:import-templates database/templates/pulse-team.json
   ```
3. The importer will upsert templates by slug, rebuild sections/blocks, and ensure the default theme exists. Metadata (`meta.source`, `meta.assets`) is stored on the template record for quick reference.
4. Seeders leverage the same importer, so executing `php artisan db:seed --class=PageBuilderSeeder` mirrors the command behaviour.

## Attaching images or media

* **Builder UI:** select a section, open the media picker, and choose/upload the background or card imagery. The selected asset is linked via the `background_media_id` or block-level media field.
* **JSON fixtures:** after uploading media through the admin panel, note the media ID and extend the section definition:
  ```json
  {
    "title": "Hero",
    "background_media_id": 42,
    "settings": {"background": {"overlay": 0.55}}
  }
  ```
  Re-importing the JSON will attach the stored asset. You can also record asset expectations in `meta.assets` so collaborators know which images to prepare before publishing.

## Publishing and unpublishing templates

* Templates start in **Draft**. From the detail drawer, click **Publish** to set the status to `published` and stamp `published_at`.
* To unpublish, change the status back to **Draft** from the UI or issue a PATCH request to `/admin/templates/{slug}` with `{ "status": "draft" }`. The record remains available for editing but is hidden from live selection lists.
* Every publish action captures the administrator ID and timestamp so you can audit changes later.

With these fixtures and tooling in place you can import, customise, and roll out new landing-page sections in minutes.
