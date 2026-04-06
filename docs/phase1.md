# Phase 1 – Project Architecture, Database Schema & Feature Breakdown

## Overview

The **Webzy** application is a premium web‑development services site built on the latest version of Laravel.  The architecture adheres to Laravel’s Model‑View‑Controller (MVC) paradigm, where **models** encapsulate the data logic, **views** handle the presentation layer and **controllers** orchestrate requests and responses.  A high‑level lifecycle of a Laravel request involves routing the request to a controller, interacting with models to retrieve or persist data and finally returning a view as the response【299524939897941†L165-L178】.  Laravel’s architecture also relies on middleware for tasks like authentication and CSRF protection【299524939897941†L180-L184】 and service providers to register and boot framework services【299524939897941†L330-L341】.

The directory structure of a standard Laravel application contains separate folders for controllers, models, service providers, configuration, migrations, views and public assets【299524939897941†L390-L437】.  Webzy leverages this structure while keeping code modular and maintainable.

## Project Structure

The project uses a **monolithic** Laravel application with clearly separated namespaces for public (front) and administrative functionality.  Below is a simplified breakdown of the primary directories and their roles:

| Directory | Purpose |
|---------|---------|
| `app/Http/Controllers/Front` | Houses controllers for the public‑facing pages such as the home page, services, portfolio, blog and contact. Each controller returns a view with dynamic data. |
| `app/Http/Controllers/Admin` | Contains controllers for the CMS.  Administrators can manage pages, services, portfolio items, blogs, categories, tags, menus, footer sections, settings, media and more.  Each controller provides CRUD methods. |
| `app/Models` | Eloquent model classes representing each database table (to be implemented in Phase 2).  Models encapsulate the business logic and define relationships. |
| `app/Providers` | Service providers used to bootstrap application components (e.g., `AppServiceProvider`, `AuthServiceProvider`, `RouteServiceProvider`).  Service providers register services and boot global behaviours【299524939897941†L330-L341】. |
| `routes/` | Route definitions: `web.php` contains all web routes with grouping for front‑end and admin; `api.php` holds API routes; `auth.php` registers auth routes. |
| `resources/views` | Blade templates for the front website (`front/…`) and the admin dashboard (`admin/…`). Layouts and partials promote reuse and maintain a consistent look. |
| `database/migrations` | Migration files defining the schema for each table. |
| `database/seeders` & `database/factories` | Seeders will populate the database with realistic content and sample data; factories generate fake data for testing. |
| `config/` | Configuration files (e.g., `app.php`) storing application settings such as timezone, providers and aliases. |
| `public/` | Document root containing `index.php` (the entry point for all requests) and compiled assets.  All requests are funnelled through this file【299524939897941†L260-L265】. |

## Feature Breakdown

The features required for Webzy are grouped into public‑facing pages and administrative modules:

### Public pages

1. **Home:** A dynamic landing page with hero banner, description of web‑development services, featured portfolio, testimonials and a newsletter signup.
2. **About Us:** Narrative about the company’s mission, history, team and values.
3. **Services:** Listing of all services offered (e.g. custom web development, e‑commerce solutions, CMS integration, UI/UX design, maintenance) with individual detail pages for each service.  Each service includes a title, summary, description, icon or image and CTA.
4. **Portfolio:** Gallery of completed projects showing title, client, industry, description, technologies used, images/screenshots and links.  Each entry has a dedicated detail page.
5. **Blog Listing:** Paginated list of blog posts with category and tag filters, search, preview image, title, excerpt and publication date.
6. **Blog Details:** Individual blog post page containing featured image, rich content, author details, categories, tags, social share buttons and related posts.  SEO meta tags and Open Graph fields will be generated dynamically.
7. **Contact Us:** Contact form for inquiries, displaying company address, phone, email and interactive Google Map.  Submitted messages are stored in the database.

### Dynamic header & footer

* **Menu management:** Administrators create menus (e.g., “Main Navigation”, “Footer Navigation”) and define menu items.  Items support nested hierarchies for dropdowns.  The header renders the selected menu; the footer loads link groups configured in the CMS.
* **Footer sections:** Several sections (About, Services, Resources, Contact) with configurable titles, content and links.  Social links and contact information are editable.
* **Theme settings:** Colour scheme, typography, logo and other brand assets are configurable via the admin interface.

### Blog system

* **Posts:** Title, slug, featured image, short description, full content (rich editor), categories (many‑to‑many), tags (many‑to‑many), meta title, meta description, meta keywords and publish status.  Posts support scheduling and drafts.
* **Categories:** Hierarchical categories to organize posts.
* **Tags:** Tags for cross‑categorization.  Posts and tags are related through a pivot table.
* **AI blog generation:** Administrators can enter a topic/title and click **Generate Blog**.  An AI integration (to be implemented in Phase 6) produces a draft including title, description, full content and SEO meta fields.  The content remains editable.

### Additional modules

1. **Services management:** CRUD interface to manage services displayed on the Services page.
2. **Portfolio management:** CRUD interface for portfolio items including image upload and project details.
3. **Pages management:** Manage static pages like home, about, custom pages and their sections.
4. **Menus & menu items:** Create menus and nested menu items for header and footer navigation.  Items can be linked to internal pages, external URLs or custom routes.  Drag‑and‑drop ordering allows easy reordering.
5. **Footer management:** Create footer sections and links for contact info, resources or quick links.
6. **Media library:** Upload and manage images and other files.  Media entries store file names, paths, types and alt text.
7. **Newsletter subscribers:** Collect email addresses via the frontend and manage subscribers.  Export functionality for marketing campaigns.
8. **Contact messages:** View and respond to messages submitted through the contact form.
9. **Settings:** Comprehensive settings pages for general site information (site title, tagline, contact info), theme customization (colours, logo), SEO defaults (meta tags, Open Graph values), social links (e.g., Facebook, Twitter, LinkedIn), Firebase configuration for push notifications and other integrations.
10. **Authentication & roles:** The admin panel is protected by authentication.  Role and permission management will be implemented (using spatie/laravel‑permission) to assign roles like Super Admin and Editor.

## Database Schema Design

The database schema is designed to support the modular CMS.  All tables will be created with Laravel migrations in **Phase 2**.  Below is an overview of the tables and their relationships:

| Table | Fields (key fields) | Description |
|------|---------------------|-------------|
| `users` | `id`, `name`, `email`, `password`, `role_id`, timestamps | Stores admin accounts.  Authentication and authorization rely on this table. |
| `pages` | `id`, `slug`, `title`, `created_by`, `updated_by`, timestamps | Represents top‑level pages such as “home” and “about”. |
| `sections` | `id`, `page_id`, `key`, `title`, `content`, `order` | Sections belonging to a page (e.g., hero banner, testimonials).  Ordered by `order`. |
| `services` | `id`, `name`, `slug`, `summary`, `description`, `icon`, `image`, `is_active`, timestamps | Business services offered by the company. |
| `portfolio` | `id`, `title`, `slug`, `client`, `category`, `description`, `image`, `link`, `completed_at`, `is_active`, timestamps | Portfolio projects; may include multiple images stored in `media` table. |
| `blog_posts` | `id`, `user_id`, `title`, `slug`, `featured_image`, `short_description`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `published_at`, `status`, timestamps | Blog posts authored by admins. |
| `blog_categories` | `id`, `name`, `slug`, `parent_id`, `description` | Categories for grouping posts; supports nested categories. |
| `blog_tags` | `id`, `name`, `slug` | Tags for posts. |
| `blog_post_tag` | `post_id`, `tag_id` | Pivot table linking posts and tags (many‑to‑many). |
| `menus` | `id`, `name`, `location` | Defines sets of menu items for header or footer. |
| `menu_items` | `id`, `menu_id`, `parent_id`, `title`, `url`, `type`, `order`, `target` | Individual menu entries; parent child relationship supports dropdowns. |
| `footer_sections` | `id`, `title`, `content`, `order` | Sections displayed in the footer (e.g., About, Services, Contact). |
| `footer_links` | `id`, `footer_section_id`, `title`, `url`, `target` | Links inside a footer section. |
| `settings` | `id`, `key`, `value` | Key/value store for general settings (site title, tagline, contact info). |
| `theme_settings` | `id`, `key`, `value` | Colours, fonts, logos and other theme‑related values. |
| `seo_data` | `id`, `model_type`, `model_id`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `og_title`, `og_description`, `og_image` | Polymorphic table storing SEO meta information for any model (pages, posts, portfolio). |
| `social_links` | `id`, `name`, `icon`, `url`, `order` | Social media profiles. |
| `newsletter_subscribers` | `id`, `email`, `status`, `created_at` | Stores subscriber email addresses and status (subscribed/unsubscribed). |
| `contact_messages` | `id`, `name`, `email`, `subject`, `message`, `ip_address`, `created_at`, `read_at` | Messages submitted via the contact form. |
| `firebase_settings` | `id`, `api_key`, `auth_domain`, `project_id`, `storage_bucket`, `messaging_sender_id`, `app_id`, `measurement_id`, `updated_at` | Firebase configuration values for push notifications. |
| `media` | `id`, `file_name`, `file_path`, `file_type`, `alt_text`, `created_at` | Uploaded media assets. |

### Relationships

- **Pages → Sections:** One‑to‑many; each page comprises multiple sections arranged by `order`.
- **Blog posts → Categories:** Many‑to‑many using a pivot table (to be named `blog_category_post` in Phase 2).  A post can belong to multiple categories, and a category can have multiple posts.
- **Blog posts → Tags:** Many‑to‑many via `blog_post_tag` table.
- **Menus → Menu items:** One‑to‑many; items may refer back to themselves via `parent_id` to build nested menus.
- **Footer sections → Footer links:** One‑to‑many; each section can have multiple links.
- **Models → SEO data:** Polymorphic one‑to‑many relationship (e.g., `Page` morphs many `SeoData` records).  This allows uniform SEO management for pages, services, portfolio items and blog posts.

## Admin Modules & Permissions

The CMS includes the following modules, accessible only to authenticated administrators:

| Module | Description |
|------|-------------|
| **Dashboard** | Provides an overview of site activity including counts of pages, services, portfolio items, blog posts, newsletter subscribers and recent contact messages. |
| **Pages** | Manage static pages and their sections.  Pages can be reordered; sections can be added, edited or removed. |
| **Services** | CRUD operations on services including icons, descriptions and images. |
| **Portfolio** | CRUD operations on portfolio items, supporting image galleries and external links. |
| **Blog Posts** | CRUD operations for blog posts.  Includes a **Generate Blog** button that triggers AI generation and pre‑fills title, description, content and SEO fields. |
| **Blog Categories & Tags** | Manage categories and tags used to organize blog posts.  Categories support nested structure. |
| **Menus & Menu Items** | Create and manage multiple menus for header and footer navigation.  Items can be linked to internal pages or external URLs.  Drag‑and‑drop ordering is supported. |
| **Footer Sections & Links** | Configure the footer layout, adding content sections and their links. |
| **Media Library** | Upload and manage images and files.  Provide metadata such as alt text for SEO.  Media can be reused across pages, services and portfolio items. |
| **Subscribers** | View and manage newsletter subscribers (export list, remove subscriber). |
| **Contacts** | View messages submitted via the contact form; mark them as read, reply or delete. |
| **Settings** | General site settings (title, tagline, contact info); theme settings (colours, fonts, logo); SEO defaults; Firebase configuration; social media links.  The settings module persists values to the `settings`, `theme_settings`, `firebase_settings` and `social_links` tables. |
| **User & Roles** (later) | Manage admin users and assign roles/permissions using spatie/laravel‑permission. |

The admin panel uses resource controllers with built‑in validation and form requests to enforce data integrity.  Middleware protects the routes, and role‑based permissions restrict access to certain modules.

## Page Structure

Each public page is broken into clearly defined sections with a strong visual hierarchy.  The home page includes a hero section, service overview, portfolio slider, testimonials, newsletter signup and client logos.  The services page lists each service with descriptive content and call‑to‑action buttons.  The portfolio page presents projects in a grid or carousel with filters.  The blog listing page shows post previews with pagination and category filters.  The contact page includes a form, map and contact details.  All pages share a cohesive header and footer.

## Next Steps

In **Phase 2** we will translate the database schema above into Laravel migrations, create Eloquent models with relationships and seed the database with realistic content.  Later phases will build the full CMS, implement dynamic front‑end pages, add AI blog generation and integrate Firebase notifications.