# Phase 6 – AI Blog Generator Integration

## Overview

In Phase 6 we introduced an AI‑powered blog generator that allows administrators to create complete blog posts with a single click. The system leverages the OpenAI API to produce a structured blog entry—title, short description, full HTML content, meta title, meta description and keywords—based on a given topic. Administrators can edit the generated content before saving, ensuring that the posts align with the company’s voice and SEO strategy.

## Key Features Added

### New Service Class

- **`App\Services\BlogGeneratorService`** – A dedicated service encapsulating all interactions with the OpenAI API. It reads the API key from `config/services.php` (environment variable `OPENAI_API_KEY`), constructs a structured prompt, sends a request to the Chat API (`gpt-3.5-turbo`) and returns a parsed associative array containing:
  - `title` – generated blog title.
  - `short_description` – one or two sentence summary.
  - `content` – 3‑5 paragraphs of HTML content.
  - `meta_title` – under 70 characters.
  - `meta_description` – under 160 characters.
  - `meta_keywords` – up to five comma‑separated keywords.
- The service throws meaningful exceptions if the API key is missing, the request fails, or the returned JSON cannot be parsed.

### Configuration

- **`config/services.php`** – Added a new configuration file that centralizes third‑party service credentials. It currently defines an `openai` section with a `key` loaded from `env('OPENAI_API_KEY')`. Administrators must add `OPENAI_API_KEY` to their `.env` file to enable generation.

### Routing

- Added a dedicated route inside the admin prefix: `POST /admin/blogs/generate` (named `admin.blogs.generate`). This route points to the new `generate` method on `Admin\BlogController` and is protected by the standard `auth` middleware. It returns a JSON response containing either generated fields or an error message.

### Controller Changes

- **Dependency Injection** – `Admin\BlogController` now injects an instance of `BlogGeneratorService` via its constructor and stores it in a protected property.
- **`generate` Method** – Validates the request for a `topic` string, invokes the generator service, and returns a JSON response with the AI‑generated content. Errors are caught and returned with a 500 status code for the front‑end to handle.

### Front‑end Integration

- **AI Topic Field** – Added a new “AI Topic” input above the main form fields in both the blog create and edit pages (`resources/views/admin/blogs/create.blade.php` and `edit.blade.php`). This field allows administrators to provide a subject for AI generation. If left blank, the system falls back to the current `title` field as the topic.
- **Generate Button Logic** – Replaced the placeholder alert with a full JavaScript implementation. When the **Generate with AI** button is clicked:
  1. The script retrieves the topic from the AI Topic field or the Title field.
  2. It sends a POST request to the `admin.blogs.generate` route with the topic in JSON format, including CSRF and Accept headers.
  3. While waiting for the response, the button is disabled and its label changes to “Generating…”.
  4. Upon success, the returned content is inserted into the corresponding input/textarea fields (`title`, `short_description`, `content`, `meta_title`, `meta_description`, `meta_keywords`).
  5. Errors are displayed via an alert, and the button is re‑enabled after completion.

## Environment Setup

To enable AI blog generation, create an `.env` entry with your OpenAI API key:

```env
OPENAI_API_KEY="sk‑your‑api‑key"
```

Without this key, the generator service will throw an exception and return an error. The configuration is intentionally separated to keep secrets out of version control.

## Usage

1. **Navigate** to *Admin → Blogs → Add Blog Post* (or Edit Blog Post).
2. **Enter** a topic in the **AI Topic** field (optional). If empty, the current title will be used.
3. **Click** **Generate with AI**. Wait for a few seconds while the AI generates the content.
4. **Review** and edit the generated fields as needed.
5. **Save** the post or cancel.

## Conclusion

Phase 6 brings powerful AI capabilities into Webzy’s CMS, streamlining content creation while maintaining full editorial control. Administrators can now produce rich, SEO‑optimized blog posts in seconds, helping the business maintain a dynamic and engaging web presence.